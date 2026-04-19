<?php
session_start();
ob_start();

header('Content-Type: application/json; charset=utf-8');

function respond($data, $code = 200) {
    ob_end_clean();
    http_response_code($code);
    echo json_encode($data);
    exit;
}

// Auth
if (empty($_SESSION['user_id']) && empty($_SESSION['email'])) {
    respond(['ok' => false, 'error' => 'Niet ingelogd.'], 401);
}

include __DIR__ . '/../../../app-db/dbcon.php';

// Resolve user ID
$userId = $_SESSION['user_id'] ?? null;
if (!$userId && !empty($_SESSION['email'])) {
    $lookup = $conn->prepare('SELECT id FROM kandidaten WHERE email = ? LIMIT 1');
    $lookup->bind_param('s', $_SESSION['email']);
    $lookup->execute();
    $lookup->bind_result($userId);
    $lookup->fetch();
    $lookup->close();
    if ($userId) $_SESSION['user_id'] = $userId;
}
if (!$userId) {
    $conn->close();
    respond(['ok' => false, 'error' => 'Gebruiker niet gevonden.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'];

// ─── GET: Fetch status updates ───────────────────────────────────────────────
if ($method === 'GET') {
    $page   = max(1, (int)($_GET['page'] ?? 1));
    $limit  = 10;
    $offset = ($page - 1) * $limit;

    $stmt = $conn->prepare("
        SELECT s.id, s.inhoud, s.created_at, k.voorletters, k.achternaam, k.profielfoto
        FROM status_updates s
        JOIN kandidaten k ON k.id = s.kandidaat_id
        WHERE s.kandidaat_id = ?
        ORDER BY s.created_at DESC
        LIMIT ? OFFSET ?
    ");
    $stmt->bind_param('iii', $userId, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = [
            'id'         => (int)$row['id'],
            'inhoud'     => htmlspecialchars($row['inhoud'], ENT_QUOTES, 'UTF-8'),
            'created_at' => $row['created_at'],
            'naam'       => htmlspecialchars(trim($row['voorletters'] . ' ' . $row['achternaam']), ENT_QUOTES, 'UTF-8'),
            'foto'       => $row['profielfoto'] ?? '',
        ];
    }
    $stmt->close();

    // Check if there are more
    $countStmt = $conn->prepare("SELECT COUNT(*) FROM status_updates WHERE kandidaat_id = ?");
    $countStmt->bind_param('i', $userId);
    $countStmt->execute();
    $countStmt->bind_result($total);
    $countStmt->fetch();
    $countStmt->close();

    $conn->close();
    respond(['ok' => true, 'posts' => $posts, 'hasMore' => ($offset + $limit) < $total]);
}

// ─── POST: Create status update ─────────────────────────────────────────────
if ($method === 'POST') {
    $input  = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? 'create';

    if ($action === 'create') {
        $inhoud = trim($input['inhoud'] ?? '');
        if ($inhoud === '') {
            $conn->close();
            respond(['ok' => false, 'error' => 'Bericht mag niet leeg zijn.'], 400);
        }
        if (mb_strlen($inhoud) > 2000) {
            $inhoud = mb_substr($inhoud, 0, 2000);
        }

        $stmt = $conn->prepare("INSERT INTO status_updates (kandidaat_id, inhoud) VALUES (?, ?)");
        $stmt->bind_param('is', $userId, $inhoud);
        $ok = $stmt->execute();
        $newId = $stmt->insert_id;
        $stmt->close();
        $conn->close();

        if ($ok) {
            $naam = trim(($_SESSION['voorletters'] ?? '') . ' ' . ($_SESSION['achternaam'] ?? ''));
            respond([
                'ok'   => true,
                'post' => [
                    'id'         => $newId,
                    'inhoud'     => htmlspecialchars($inhoud, ENT_QUOTES, 'UTF-8'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'naam'       => htmlspecialchars($naam, ENT_QUOTES, 'UTF-8'),
                    'foto'       => $_SESSION['profielfoto'] ?? '',
                ]
            ]);
        } else {
            respond(['ok' => false, 'error' => 'Opslaan mislukt.'], 500);
        }
    }

    if ($action === 'delete') {
        $postId = (int)($input['id'] ?? 0);
        if ($postId <= 0) {
            $conn->close();
            respond(['ok' => false, 'error' => 'Ongeldig bericht.'], 400);
        }
        // Only allow deleting own posts
        $stmt = $conn->prepare("DELETE FROM status_updates WHERE id = ? AND kandidaat_id = ? LIMIT 1");
        $stmt->bind_param('ii', $postId, $userId);
        $ok = $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();
        $conn->close();

        if ($ok && $affected > 0) {
            respond(['ok' => true]);
        } else {
            respond(['ok' => false, 'error' => 'Verwijderen mislukt.'], 404);
        }
    }

    $conn->close();
    respond(['ok' => false, 'error' => 'Onbekende actie.'], 400);
}

$conn->close();
respond(['ok' => false, 'error' => 'Methode niet toegestaan.'], 405);
