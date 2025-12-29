<?php
$host = "127.0.0.1";
$user = "root";
$pass = "database-mc1";
$db   = "selectworks"; // or your actual DB name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully!";
