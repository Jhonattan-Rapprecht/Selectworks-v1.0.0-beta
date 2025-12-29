<?php

$servername = "db";
$username   = "root";
$password   = "root";
$dbname     = "selectworks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Verbinden mislukt: " . $conn->connect_error);
}

?>