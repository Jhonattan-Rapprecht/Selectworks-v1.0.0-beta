<?php
$conn = new mysqli('127.0.0.1', 'root', 'root', 'selectworks');
if ($conn->connect_error) die('Connection failed: ' . $conn->connect_error);

$sql = "CREATE TABLE IF NOT EXISTS status_updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kandidaat_id INT NOT NULL,
    inhoud TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_kandidaat (kandidaat_id),
    FOREIGN KEY (kandidaat_id) REFERENCES kandidaten(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql)) {
    echo "Table status_updates created/exists.\n";
} else {
    echo "Error: " . $conn->error . "\n";
}
$conn->close();
