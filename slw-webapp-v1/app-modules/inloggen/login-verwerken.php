<?php
session_start();

include __DIR__ . '/../../app-db/dbcon.php';

/*
|--------------------------------------------------------------------------
| CSRF validation
|--------------------------------------------------------------------------
*/
if (
    empty($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])
) {
    $_SESSION['login_error'] = 'Ongeldige sessie. Probeer het opnieuw.';
    header('Location: /inlogportaal');
    exit;
}

/*
|--------------------------------------------------------------------------
| Credential login
|--------------------------------------------------------------------------
*/
if (
    isset($_POST['submit']) &&
    !empty($_POST['email']) &&
    !empty($_POST['wachtwoord'])
) {
    $email      = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // Prepared statement – prevents SQL injection
    $stmt = $conn->prepare('SELECT * FROM kandidaten WHERE email = ? LIMIT 1');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($wachtwoord, $row['wachtwoord'])) {
            // Regenerate session to prevent fixation
            session_regenerate_id(true);

            $_SESSION['user_id']        = $row['id'];
            $_SESSION['email']          = $row['email'];
            $_SESSION['name']           = trim(($row['voorletters'] ?? '') . ' ' . ($row['achternaam'] ?? ''));
            $_SESSION['voorletters']    = $row['voorletters'] ?? '';
            $_SESSION['achternaam']     = $row['achternaam'] ?? '';
            $_SESSION['geboortedatum']  = $row['geboortedatum'] ?? '';
            $_SESSION['geslacht']       = $row['geslacht'] ?? '';
            $_SESSION['straatnaam']     = $row['straatnaam'] ?? '';
            $_SESSION['huisnummer']     = $row['huisnummer_toevoeging'] ?? '';
            $_SESSION['postcode']       = $row['postcode'] ?? '';
            $_SESSION['woonplaats']     = $row['woonplaats'] ?? '';
            $_SESSION['telefoonnummer'] = $row['telefoonnummer'] ?? '';
            $_SESSION['bio']            = $row['biografie'] ?? '';
            $_SESSION['functie_titel']  = $row['functie_titel'] ?? '';
            $_SESSION['profielfoto']    = $row['profielfoto'] ?? '';
            $_SESSION['linkedin']       = $row['linkedin'] ?? '';
            $_SESSION['created_at']     = $row['created_at'] ?? '';

            header('Location: /slw-webapp-v1/app-modules/profielen/prfl-wrkzknde/profielpagina.php');
            exit;
        }
    }

    // Generic message – don't reveal whether e-mail exists
    $_SESSION['login_error'] = 'E-mailadres of wachtwoord is onjuist.';
    header('Location: /inlogportaal');
    exit;

} else {
    $_SESSION['login_error'] = 'Vul alle velden in.';
    header('Location: /inlogportaal');
    exit;
}

