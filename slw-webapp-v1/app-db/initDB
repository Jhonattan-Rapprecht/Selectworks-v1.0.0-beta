<?php

// Load DB connection
require __DIR__ . '/dbcon.php';

// List of tables and their CREATE statements
$tables = [

    'kandidaten' => "
        CREATE TABLE IF NOT EXISTS kandidaten (
            id INT AUTO_INCREMENT PRIMARY KEY,
            Voorletters VARCHAR(50),
            Achternaam VARCHAR(100),
            Geboortedatum DATE,
            Geslacht ENUM('man','vrouw'),
            Straatnaam VARCHAR(100),
            Huisnummer_toevoeging VARCHAR(20),
            Postcode VARCHAR(10),
            Woonplaats VARCHAR(100),
            Telefoonnummer VARCHAR(20),
            Email VARCHAR(255) UNIQUE,
            Wachtwoord VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ",

    // Add future tables here:
    // 'vacatures' => "CREATE TABLE IF NOT EXISTS vacatures (...)",
    // 'werkgevers' => "CREATE TABLE IF NOT EXISTS werkgevers (...)",
];

// Loop through tables and create missing ones
foreach ($tables as $table => $sql) {

    $check = $conn->query("SHOW TABLES LIKE '$table'");

    if ($check && $check->num_rows == 0) {
        echo "Creating table: $table<br>";
        if ($conn->query($sql) === TRUE) {
            echo "Table '$table' created successfully.<br>";
        } else {
            echo "Error creating table '$table': " . $conn->error . "<br>";
        }
    } else {
        echo "Table '$table' already exists.<br>";
    }
}

echo "<br>Database initialization complete.";

$conn->close();
