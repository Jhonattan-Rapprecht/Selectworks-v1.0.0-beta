<?php

require __DIR__ . '/../dbcon.php';
require __DIR__ . '/seederFunctions.php';

$count = intval($_POST['count']);
$type  = $_POST['type'];

echo "<h2>Generating $count candidates of type '$type'</h2>";

for ($i = 0; $i < $count; $i++) {

    $data = generateCandidate($type);

    $sql = "
        INSERT INTO kandidaten 
        (Voorletters, Achternaam, Geboortedatum, Geslacht, Straatnaam, 
         Huisnummer_toevoeging, Postcode, Woonplaats, Telefoonnummer, 
         Email, Wachtwoord)
        VALUES (
            '{$data['Voorletters']}',
            '{$data['Achternaam']}',
            '{$data['Geboortedatum']}',
            '{$data['Geslacht']}',
            '{$data['Straatnaam']}',
            '{$data['Huisnummer_toevoeging']}',
            '{$data['Postcode']}',
            '{$data['Woonplaats']}',
            '{$data['Telefoonnummer']}',
            '{$data['Email']}',
            '{$data['Wachtwoord']}'
        )
    ";

    if ($conn->query($sql)) {
        echo "Inserted: {$data['Email']}<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

echo "<br><strong>Seeder completed.</strong>";

$conn->close();
