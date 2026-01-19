<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Protect the page: only logged-in users may access it
if (!isset($_SESSION['email'])) {
    header("Location: /slw-webapp-v1/app-modules/inloggen/inloggen.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <title>Profielpagina - Selectworks</title>
    <link rel="stylesheet" href="profile_style.css">
</head>

<body>

<!-- TOP NAVBAR -->
<div class="top-navbar">

    <p id="user_greet">
        Dit is de profielpagina van:
        <b><?php echo htmlspecialchars($_SESSION['name']); ?></b>
    </p>

    <p id="current_time">
        <script>
            function startTime() {
                const today = new Date();
                let h = today.getHours();
                let m = today.getMinutes();
                let s = today.getSeconds();

                m = (m < 10 ? "0" + m : m);
                s = (s < 10 ? "0" + s : s);

                document.getElementById('current_time').innerHTML =
                    "De tijd is: <b>" + h + ":" + m + ":" + s +
                    "</b> | <a href=\"/slw-webapp-v1/app-modules/inloggen/logout.php\">Uitloggen</a>";

                setTimeout(startTime, 500);
            }
            startTime();
        </script>
    </p>

</div>

<!-- HEADER -->
<div class="header_info">
    <h2 style="text-align: center;">Welkom op jouw profielpagina!</h2>
</div>


<?php


function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}


?>


<!-- MAIN WRAPPER -->
<div class="wrapper">

    <div class="side_nav"><h3>Navigatie 1</h3></div>

    <div class="box">

        <!-- USER INFO SECTION -->
        <div class="user_info">

            <img id="profile_picture"
                 src="/slw-webapp-v1/app-data/media/images/Profile images/avatar-default-med.png"
                 alt="Profiel foto">

            <table id="user_data">
                <tr>
                    <th>Naam:</th>
                    <td><?php echo e($_SESSION['name']); ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo e($_SESSION['email']); ?></td>
                </tr>
                <tr>
                    <th>Geboortedatum:</th>
                    <td><?php echo e($_SESSION['age']); ?></td>
                </tr>
                <tr>
                    <th>Biografie:</th>
                    <td><?php echo nl2br(e($_SESSION['bio'])); ?></td>
                </tr>
            </table>

        </div>

        <!-- CONTENT SECTIONS -->
        <div class="user_work"><h3>Werkverleden</h3></div>
        <div class="user_work"><h3>Ambities</h3></div>
        <div class="user_work"><h3>Korte termijn doelen</h3></div>
        <div class="user_work"><h3>Lange termijn doelen</h3></div>
        <div class="user_work"><h3>Test text.</h3></div>
        <div class="user_work"><h3>Test text.</h3></div>
        <div class="user_work"><h3>Test text.</h3></div>
        <div class="user_work"><h3>Test text.</h3></div>
        <div class="user_work"><h3>Test text.</h3></div>

    </div>

    <div class="side_nav_right"><h3>Navigatie 2</h3></div>

</div>

<div class="footer"></div>

</body>
</html>
