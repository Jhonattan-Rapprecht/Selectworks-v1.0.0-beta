<?php

require BASE_PATH . '/slw-webapp-v1/app-includes/header/header.php';
require BASE_PATH . '/slw-webapp-v1/app-includes/navbar/navbar.php';
require BASE_PATH . '/slw-webapp-v1/app-includes/page-header/page-header.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $error = 'Vul alle velden in.';
    } else {
        $to = "jhonattan.rapprecht@gmail.com";
        $subject = "Nieuw bericht via contactformulier";

        $html = "
        <html>
        <body>
        <h3>Nieuw bericht via Selectworks contactformulier</h3>
        <p><strong>Naam:</strong> " . htmlspecialchars($name) . "</p>
        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
        <p><strong>Bericht:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
        </body>
        </html>";

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "From: <webmaster@selectworks.nl>\r\n";

        if (mail($to, $subject, $html, $headers)) {
            $sent = true;
        } else {
            $error = 'Bericht kon niet worden verzonden.';
        }
    }
}
?>

<main style="flex:1;">
    <div style="max-width:600px;margin:40px auto;font-family:Arial;">

        <h1>Contact</h1>

        <?php if ($sent): ?>
            <div style="padding:10px;background:#d4edda;color:#155724;border-radius:4px;margin-bottom:15px;">
                Bedankt! Uw bericht is verzonden.
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div style="padding:10px;background:#f8d7da;color:#721c24;border-radius:4px;margin-bottom:15px;">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/contact">
            <label>Naam</label>
            <input
                type="text"
                name="name"
                placeholder="Uw naam"
                style="width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:4px;"
                value="<?= htmlspecialchars($name ?? ''); ?>">

            <label>Email</label>
            <input
                type="email"
                name="email"
                placeholder="Uw email"
                style="width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:4px;"
                value="<?= htmlspecialchars($email ?? ''); ?>">

            <label>Bericht</label>
            <textarea
                name="message"
                rows="5"
                placeholder="Uw bericht"
                style="width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:4px;"><?= htmlspecialchars($message ?? ''); ?></textarea>

            <button
                type="submit"
                style="padding:10px 20px;background:#007bff;color:white;border:none;border-radius:4px;cursor:pointer;">
                Verzenden
            </button>
        </form>

    </div>
</main>

<?php require BASE_PATH . '/slw-webapp-v1/app-includes/footer/footer.php'; ?>