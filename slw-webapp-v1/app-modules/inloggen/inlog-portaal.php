<?php
session_start();

// Load SSO configuration
$ssoConfig = require __DIR__ . '/sso-config.php';

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];

// Flash message from login handler
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SelectWorks inlogportaal">
    <meta name="author" content="Jhonattan M. Rapprecht">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="/slw-webapp-v1/app-modules/inloggen/inl-prtl.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Inloggen | SelectWorks.nl</title>
</head>
<body>

<!-- Navbar -->
<div class="container-fluid">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="/business">Voor werkgevers</a></li>
                    <li><a href="/vacatures">Vacatures</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/inschrijven"><span class="glyphicon glyphicon-user"></span> Inschrijven</a></li>
                    <li class="active"><a href="/inlogportaal"><span class="glyphicon glyphicon-log-in"></span> Inloggen</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Logo header -->
<div class="page-header">
    <p>
        <a href="/">
            <img src="/slw-webapp-v1/app-data/media/logos/Selectworks-type1-barebones2.png" alt="SelectWorks Home">
        </a>
    </p>
</div>

<!-- Login card -->
<div class="login-card">

    <h2 class="login-heading">Inloggen</h2>
    <p class="login-subtext">Welkom terug bij SelectWorks</p>

    <!-- Error alert -->
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <!-- SSO buttons -->
    <?php if (!empty($ssoConfig['providers'])): ?>
        <div class="sso-section">
            <?php foreach ($ssoConfig['providers'] as $key => $provider): ?>
                <?php if ($provider['enabled']): ?>
                    <a href="/sso/<?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>" class="btn-sso btn-sso-<?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>">
                        <span class="sso-icon"><?php echo $provider['icon']; ?></span>
                        Doorgaan met <?php echo htmlspecialchars($provider['label'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="divider"><span>of log in met e-mail</span></div>
    <?php endif; ?>

    <!-- Email / password form -->
    <form name="inlog-portaal" method="post" action="/inloggen" autocomplete="on">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">

        <label for="inputEmail">E-mailadres</label>
        <input type="email" id="inputEmail" name="email" class="form-control"
               placeholder="naam@bedrijf.nl" required autofocus autocomplete="email">

        <label for="inputPassword">Wachtwoord</label>
        <input type="password" id="inputPassword" name="wachtwoord" class="form-control"
               placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" required autocomplete="current-password">

        <div class="form-row-between">
            <label class="remember-label">
                <input type="checkbox" name="remember_me" value="1"> Onthoud mij
            </label>
            <a href="/wachtwoord-vergeten" class="forgot-link">Wachtwoord vergeten?</a>
        </div>

        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Inloggen</button>
    </form>

    <p class="signup-prompt">Nog geen account? <a href="/inschrijven">Maak een account aan</a></p>

</div><!-- /login-card -->

<footer>
    <p>
        <a href="/">Selectworks.nl</a> | Alle rechten voorbehouden &copy;
        <b>2018 – <?php echo date("Y"); ?></b> |
        Website ontwikkeld door: <a href="https://rapprecht.nl"><b>J.M. Rapprecht</b></a>
    </p>
</footer>

</body>
</html>