<?php
session_start();

/* =========================================================================
   SelectWorks – Registration handler (inschrijving-verwerken.php)
   Secure: CSRF, prepared statements, password confirmation, flash messages
   ========================================================================= */

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /inschrijven');
    exit;
}

// --- CSRF validation -----------------------------------------------------
if (
    empty($_POST['csrf_token']) ||
    !isset($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    $_SESSION['reg_error'] = 'Ongeldige sessie. Probeer het opnieuw.';
    header('Location: /inschrijven');
    exit;
}

// Consume the token so it can't be reused
unset($_SESSION['csrf_token']);

// --- DB connection -------------------------------------------------------
include __DIR__ . '/../../app-db/dbcon.php';

// --- Helper: trim input --------------------------------------------------
function clean(string $key): string {
    return trim($_POST[$key] ?? '');
}

// --- Collect fields ------------------------------------------------------
$voorletters          = clean('voorletters');
$achternaam           = clean('achternaam');
$geboortedatum        = clean('geboortedatum');
$geslacht             = clean('geslacht');
$straatnaam           = clean('straatnaam');
$huisnummer_toevoeging = clean('huisnummer_toevoeging');
$postcode             = clean('postcode');
$woonplaats           = clean('woonplaats');
$telnr                = clean('telnr');
$email                = clean('email');
$wachtwoord           = clean('wachtwoord');
$wachtwoord_confirm   = clean('wachtwoord_herhaal');

// Repopulation data in case of error redirect
$_SESSION['reg_old'] = $_POST;
unset($_SESSION['reg_old']['wachtwoord'], $_SESSION['reg_old']['wachtwoord_bevestig'], $_SESSION['reg_old']['csrf_token']);

// --- Server-side validation ----------------------------------------------
$errors = [];

if ($voorletters === '')    $errors[] = 'Voorletters zijn verplicht.';
if ($achternaam === '')     $errors[] = 'Achternaam is verplicht.';
if ($geboortedatum === '')  $errors[] = 'Geboortedatum is verplicht.';
if (!in_array($geslacht, ['man', 'vrouw', 'anders'], true)) $errors[] = 'Kies een geldig geslacht.';
if ($straatnaam === '')     $errors[] = 'Straatnaam is verplicht.';
if ($postcode === '')       $errors[] = 'Postcode is verplicht.';
if ($woonplaats === '')     $errors[] = 'Woonplaats is verplicht.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Ongeldig e-mailadres.';
if (strlen($wachtwoord) < 8) $errors[] = 'Wachtwoord moet minimaal 8 tekens zijn.';
if ($wachtwoord !== $wachtwoord_confirm) $errors[] = 'Wachtwoorden komen niet overeen.';

// Check for duplicate email (prepared statement)
if (empty($errors)) {
    $check = $conn->prepare('SELECT id FROM kandidaten WHERE email = ? LIMIT 1');
    $check->bind_param('s', $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $errors[] = 'Dit e-mailadres is al geregistreerd.';
    }
    $check->close();
}

if (!empty($errors)) {
    $_SESSION['reg_error'] = implode('<br>', $errors);
    header('Location: /inschrijven');
    exit;
}

// --- Hash password -------------------------------------------------------
$hashed = password_hash($wachtwoord, PASSWORD_DEFAULT);

// --- Insert with prepared statement --------------------------------------
$stmt = $conn->prepare(
    'INSERT INTO kandidaten
        (voorletters, achternaam, geboortedatum, geslacht,
         straatnaam, huisnummer_toevoeging, postcode, woonplaats,
         telefoonnummer, email, wachtwoord)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);
$stmt->bind_param(
    'sssssssssss',
    $voorletters, $achternaam, $geboortedatum, $geslacht,
    $straatnaam, $huisnummer_toevoeging, $postcode, $woonplaats,
    $telnr, $email, $hashed
);

if ($stmt->execute()) {
    // Clear repopulation data on success
    unset($_SESSION['reg_old']);
    $_SESSION['reg_success'] = 'Account aangemaakt! Je kunt nu inloggen.';
    $stmt->close();
    $conn->close();
    header('Location: /inlogportaal');
    exit;
}

// Insert failed
$_SESSION['reg_error'] = 'Er is iets misgegaan. Probeer het later opnieuw.';
$stmt->close();
$conn->close();
header('Location: /inschrijven');
exit;
