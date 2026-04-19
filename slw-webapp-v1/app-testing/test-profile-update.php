<?php
// Simulate the exact flow: session_start + include profile-update logic
session_start();

echo "Session contents:\n";
echo "user_id: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "email: " . ($_SESSION['email'] ?? 'NOT SET') . "\n";
echo "\n";

// Now simulate what happens when profile-update.php is included through index.php
// Fake the POST request
$_SERVER['REQUEST_METHOD'] = 'POST';

// Write the JSON to a temp file and test json_decode on it
$json = '{"field":"bio","value":"test bio"}';
echo "Input JSON: $json\n";
$decoded = json_decode($json, true);
echo "Decoded: " . print_r($decoded, true) . "\n";

// Test the DB connection include
echo "Including dbcon.php...\n";
ob_start();
include __DIR__ . '/../app-db/dbcon.php';
$dbOutput = ob_get_clean();
echo "dbcon.php output: [$dbOutput]\n";
echo "Connection: " . ($conn->connect_error ? $conn->connect_error : 'OK') . "\n";

// Test the actual query
$stmt = $conn->prepare("UPDATE kandidaten SET biografie = ? WHERE id = ? LIMIT 1");
if ($stmt === false) {
    echo "Prepare error: " . $conn->error . "\n";
} else {
    echo "Prepare: OK\n";
    $val = 'test bio';
    $id = 1;
    $stmt->bind_param('si', $val, $id);
    echo "Execute: " . ($stmt->execute() ? 'OK' : $stmt->error) . "\n";
    $stmt->close();
}
$conn->close();
