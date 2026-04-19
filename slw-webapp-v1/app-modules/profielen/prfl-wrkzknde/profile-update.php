<?php
session_start();

// Suppress any stray output from includes
ob_start();

header('Content-Type: application/json; charset=utf-8');

// DEBUG log
$debugLog = __DIR__ . '/profile-update-debug.log';
$raw = file_get_contents('php://input');

/* =========================================================================
   SelectWorks – AJAX profile field updater
   Accepts: POST { field: <column>, value: <new_value> }
   Returns: { ok: true } or { ok: false, error: "..." }
   ========================================================================= */

function respond($data, $code = 200) {
    global $debugLog;
    // Discard any stray output from includes
    ob_end_clean();
    http_response_code($code);
    $json = json_encode($data);
    file_put_contents($debugLog, date('H:i:s') . " RESPONSE ($code): $json\n---\n", FILE_APPEND);
    echo $json;
    exit;
}

// Auth check
if (empty($_SESSION['user_id']) && empty($_SESSION['email'])) {
    respond(['ok' => false, 'error' => 'Niet ingelogd.'], 401);
}

// Only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['ok' => false, 'error' => 'Methode niet toegestaan.'], 405);
}

$input = json_decode($raw, true);
$field = $input['field'] ?? '';
$value = trim($input['value'] ?? '');

file_put_contents($debugLog,
    date('H:i:s') . " user_id=" . ($_SESSION['user_id'] ?? 'null') .
    " email=" . ($_SESSION['email'] ?? 'null') .
    " field=$field value=$value\n", FILE_APPEND);

// Whitelist of editable fields => [db_column, max_length, session_key]
$allowed = [
    'bio'           => ['biografie',           2000, 'bio'],
    'functie_titel' => ['functie_titel',        150, 'functie_titel'],
    'telefoonnummer'=> ['telefoonnummer',        20, 'telefoonnummer'],
    'woonplaats'    => ['woonplaats',           100, 'woonplaats'],
    'linkedin'      => ['linkedin',             255, 'linkedin'],
    'voorletters'   => ['voorletters',           50, 'voorletters'],
    'achternaam'    => ['achternaam',           100, 'achternaam'],
];

if (!isset($allowed[$field])) {
    respond(['ok' => false, 'error' => 'Veld niet bewerkbaar.'], 400);
}

[$column, $maxLen, $sessionKey] = $allowed[$field];

if (mb_strlen($value) > $maxLen) {
    $value = mb_substr($value, 0, $maxLen);
}

// DB connection
include __DIR__ . '/../../../app-db/dbcon.php';

// Resolve user
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

$stmt = $conn->prepare("UPDATE kandidaten SET {$column} = ? WHERE id = ? LIMIT 1");
$stmt->bind_param('si', $value, $userId);
$ok = $stmt->execute();
$err = $stmt->error;
$stmt->close();
$conn->close();

if ($ok) {
    $_SESSION[$sessionKey] = $value;
    if ($field === 'voorletters' || $field === 'achternaam') {
        $_SESSION['name'] = trim(($_SESSION['voorletters'] ?? '') . ' ' . ($_SESSION['achternaam'] ?? ''));
    }
    respond(['ok' => true, 'value' => $value]);
} else {
    file_put_contents($debugLog, date('H:i:s') . " SQL ERROR: $err\n", FILE_APPEND);
    respond(['ok' => false, 'error' => 'Opslaan mislukt.'], 500);
}
