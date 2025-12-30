<?php
session_start();

// Correct include path
include __DIR__ . '/../../app-db/dbcon.php';

echo "<p> Dit is de pagina waar leden terechtkomen nadat ze op de registreer knop hebben gedrukt </p>";

// Initialize variables
$voorletters = $achternaam = $geboortedatum = $geslacht = $straatnaam = 
$huisnummer_toevoeging = $postcode = $woonplaats = $telnr = 
$email = $wachtwoord = "";

// Handle POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $voorletters = test_input($_POST["voorletters"]);
    $achternaam = test_input($_POST["achternaam"]);
    $geboortedatum = test_input($_POST["geboortedatum"]);
    $geslacht = test_input($_POST["geslacht"]);
    $straatnaam = test_input($_POST["straatnaam"]);
    $huisnummer_toevoeging = test_input($_POST["huisnummer_toevoeging"]);
    $postcode = test_input($_POST["postcode"]);
    $woonplaats = test_input($_POST["woonplaats"]);
    $telnr = test_input($_POST["telnr"]);
    $email = test_input($_POST["email"]);
    $wachtwoord = test_input($_POST["wachtwoord"]);

    // Hash password
    $hashed = password_hash($wachtwoord, PASSWORD_DEFAULT);

    // Insert into DB
    $sql = "INSERT INTO kandidaten (Voorletters, Email, Wachtwoord)
            VALUES ('$voorletters', '$email', '$hashed')";

    if ($conn->query($sql) === TRUE) {
        echo "Nieuwe data is opgeslagen in de database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Sanitizer
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<h2>Your Input:</h2>
<?php
echo $voorletters . "<br>";
echo $achternaam . "<br>";
echo $geboortedatum . "<br>";
echo $geslacht . "<br>";
echo $straatnaam . "<br>";
echo $huisnummer_toevoeging . "<br>";
echo $postcode . "<br>";
echo $woonplaats . "<br>";
echo $telnr . "<br>";
echo $email . "<br>";
echo $wachtwoord . "<br>";
?>
