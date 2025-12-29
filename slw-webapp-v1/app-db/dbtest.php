<?php
header('Content-Type: application/json; charset=utf-8');

$result = ['success' => false];

try {
	$path = __DIR__ . '/dbcon.php';

	if (file_exists($path)) {
		include $path; // expects $conn (mysqli)

		if (isset($conn) && $conn instanceof mysqli) {
			if ($conn->connect_error) {
				$result['error'] = 'Connect error: ' . $conn->connect_error;
			} else {
				$result['success'] = true;
				$result['connected'] = true;
				$res = $conn->query("SELECT DATABASE() AS db, NOW() AS now");
				if ($res) {
					$row = $res->fetch_assoc();
					$result['database'] = $row['db'];
					$result['now'] = $row['now'];
				}
				$result['server_info'] = $conn->server_info ?? null;
				$conn->close();
			}
		} else {
			$result['error'] = 'dbcon.php did not provide a mysqli $conn instance.';
		}

	} else {
		// Fallback: try a direct connection using common env vars or localhost
		$s = getenv('DB_HOST') ?: '127.0.0.1';
		$u = getenv('DB_USER') ?: 'root';
		$p = getenv('DB_PASS') ?: '';
		$db = getenv('DB_NAME') ?: '';

		$tmp = @new mysqli($s, $u, $p, $db);
		if ($tmp && !$tmp->connect_error) {
			$result['success'] = true;
			$result['connected'] = true;
			$res = $tmp->query("SELECT DATABASE() AS db, NOW() AS now");
			if ($res) {
				$row = $res->fetch_assoc();
				$result['database'] = $row['db'];
				$result['now'] = $row['now'];
			}
			$result['server_info'] = $tmp->server_info ?? null;
			$tmp->close();
		} else {
			$result['error'] = 'No dbcon.php and fallback connection failed: ' . ($tmp ? $tmp->connect_error : 'unknown');
		}
	}

} catch (Throwable $e) {
	$result['error'] = $e->getMessage();
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

?>
