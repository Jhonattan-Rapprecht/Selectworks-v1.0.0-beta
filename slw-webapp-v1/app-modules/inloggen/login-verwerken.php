<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo __FILE__;

include __DIR__ . '/../../app-db/dbcon.php';

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['wachtwoord'])) {

    $email      = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // Query only by email
    $sql = "SELECT * FROM kandidaten WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($wachtwoord, $row['wachtwoord'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email']   = $row['email'];

            // Optional: build a display name
            $_SESSION['name'] = $row['voorletters'] . ' ' . $row['achternaam'];

            // Optional: if you want age, calculate it later
            $_SESSION['age'] = $row['geboortedatum'];

            // Optional: if you add a bio column later
            $_SESSION['bio'] = $row['biografie'] ?? '';

            header("Location: /slw-webapp-v1/app-modules/profielen/prfl-wrkzknde/profielpagina.php");
            exit;
        } else {
            echo "Wachtwoord is onjuist.";
        }

    } else {
        echo "Email bestaat niet.";
    }

} else {
    echo "Vul alle velden in.";
}
?>
