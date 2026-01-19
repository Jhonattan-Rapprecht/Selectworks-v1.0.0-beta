<?php

// Load DB connection
require __DIR__ . '/dbcon.php';

// List of tables and their CREATE statements
$tables = [

    'kandidaten' => "
        CREATE TABLE IF NOT EXISTS kandidaten (
            id INT AUTO_INCREMENT PRIMARY KEY,
            voorletters VARCHAR(50),
            achternaam VARCHAR(100),
            geboortedatum DATE,
            geslacht ENUM('man','vrouw'),
            straatnaam VARCHAR(100),
            huisnummer_toevoeging VARCHAR(20),
            postcode VARCHAR(10),
            woonplaats VARCHAR(100),
            telefoonnummer VARCHAR(20),
            email VARCHAR(255) UNIQUE,
            wachtwoord VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ",

    // Future tables can follow the same naming convention:
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
