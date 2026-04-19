<?php
session_start();

// CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];

// Flash messages from handler
$error   = $_SESSION['reg_error']   ?? '';
$success = $_SESSION['reg_success'] ?? '';
unset($_SESSION['reg_error'], $_SESSION['reg_success']);

// Repopulate fields on validation failure
$old = $_SESSION['reg_old'] ?? [];
unset($_SESSION['reg_old']);
function old($key, $fallback = '') {
    global $old;
    return htmlspecialchars($old[$key] ?? $fallback, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SelectWorks inschrijfformulier">
    <meta name="author" content="Jhonattan M. Rapprecht">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="/slw-webapp-v1/app-modules/inschrijven/inschrijven.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Inschrijven | SelectWorks.nl</title>
</head>
<body>

<!-- Navbar -->
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
                <li class="active"><a href="/inschrijven"><span class="glyphicon glyphicon-user"></span> Inschrijven</a></li>
                <li><a href="/inlogportaal"><span class="glyphicon glyphicon-log-in"></span> Inloggen</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Logo header -->
<div class="page-header">
    <a href="/"><img src="/slw-webapp-v1/app-data/media/logos/Selectworks-type1-barebones2.png" alt="SelectWorks Home"></a>
</div>

<!-- Registration card -->
<div class="reg-card">

    <h2 class="reg-heading">Account aanmaken</h2>
    <p class="reg-subtext">Vul het formulier in om je in te schrijven bij SelectWorks</p>

    <!-- Flash messages -->
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <!-- Step indicators -->
    <div class="steps">
        <div class="step active" data-step="1"><span class="step-num">1</span> Persoonlijk</div>
        <div class="step" data-step="2"><span class="step-num">2</span> Adres</div>
        <div class="step" data-step="3"><span class="step-num">3</span> Contact &amp; Login</div>
    </div>

    <form method="post" action="/inschrijven-verwerken" autocomplete="on" id="regForm">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">

        <!-- Step 1: Persoonlijke informatie -->
        <div class="form-step active" id="step-1">
            <h3 class="section-title">Persoonlijke informatie</h3>

            <div class="form-row-2">
                <div class="field">
                    <label for="voorletters">Voorletters</label>
                    <input type="text" id="voorletters" name="voorletters" class="form-control"
                           placeholder="J.M." value="<?php echo old('voorletters'); ?>" required>
                </div>
                <div class="field">
                    <label for="achternaam">Achternaam</label>
                    <input type="text" id="achternaam" name="achternaam" class="form-control"
                           placeholder="Jansen" value="<?php echo old('achternaam'); ?>" required>
                </div>
            </div>

            <div class="form-row-2">
                <div class="field">
                    <label for="geboortedatum">Geboortedatum</label>
                    <input type="date" id="geboortedatum" name="geboortedatum" class="form-control"
                           value="<?php echo old('geboortedatum'); ?>" required>
                </div>
                <div class="field">
                    <label>Geslacht</label>
                    <div class="radio-group">
                        <label class="radio-label"><input type="radio" name="geslacht" value="man" <?php echo (old('geslacht','man')==='man')?'checked':''; ?>> Man</label>
                        <label class="radio-label"><input type="radio" name="geslacht" value="vrouw" <?php echo (old('geslacht')==='vrouw')?'checked':''; ?>> Vrouw</label>
                        <label class="radio-label"><input type="radio" name="geslacht" value="anders" <?php echo (old('geslacht')==='anders')?'checked':''; ?>> Anders</label>
                    </div>
                </div>
            </div>

            <div class="step-actions">
                <span></span>
                <button type="button" class="btn-next" onclick="goStep(2)">Volgende &rarr;</button>
            </div>
        </div>

        <!-- Step 2: Adresgegevens -->
        <div class="form-step" id="step-2">
            <h3 class="section-title">Adresgegevens</h3>

            <div class="form-row-2">
                <div class="field" style="flex:2">
                    <label for="straatnaam">Straatnaam</label>
                    <input type="text" id="straatnaam" name="straatnaam" class="form-control"
                           placeholder="Keizersgracht" value="<?php echo old('straatnaam'); ?>" required>
                </div>
                <div class="field" style="flex:1">
                    <label for="huisnummer_toevoeging">Huisnr + toev.</label>
                    <input type="text" id="huisnummer_toevoeging" name="huisnummer_toevoeging" class="form-control"
                           placeholder="42a" value="<?php echo old('huisnummer_toevoeging'); ?>" required>
                </div>
            </div>

            <div class="form-row-2">
                <div class="field">
                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" name="postcode" class="form-control"
                           placeholder="1234 AB" value="<?php echo old('postcode'); ?>" required>
                </div>
                <div class="field">
                    <label for="woonplaats">Woonplaats</label>
                    <input type="text" id="woonplaats" name="woonplaats" class="form-control"
                           placeholder="Amsterdam" value="<?php echo old('woonplaats'); ?>" required>
                </div>
            </div>

            <div class="step-actions">
                <button type="button" class="btn-prev" onclick="goStep(1)">&larr; Terug</button>
                <button type="button" class="btn-next" onclick="goStep(3)">Volgende &rarr;</button>
            </div>
        </div>

        <!-- Step 3: Contact & Login -->
        <div class="form-step" id="step-3">
            <h3 class="section-title">Contact &amp; Inloggegevens</h3>

            <div class="field">
                <label for="telnr">Telefoonnummer</label>
                <input type="tel" id="telnr" name="telnr" class="form-control"
                       placeholder="06-12345678" value="<?php echo old('telnr'); ?>" required>
            </div>

            <div class="field">
                <label for="email">E-mailadres</label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="naam@bedrijf.nl" value="<?php echo old('email'); ?>" required autocomplete="email">
            </div>

            <div class="form-row-2">
                <div class="field">
                    <label for="wachtwoord">Wachtwoord</label>
                    <input type="password" id="wachtwoord" name="wachtwoord" class="form-control"
                           placeholder="Minimaal 8 tekens" required minlength="8" autocomplete="new-password">
                </div>
                <div class="field">
                    <label for="wachtwoord_herhaal">Herhaal wachtwoord</label>
                    <input type="password" id="wachtwoord_herhaal" name="wachtwoord_herhaal" class="form-control"
                           placeholder="Herhaal" required minlength="8" autocomplete="new-password">
                </div>
            </div>

            <div class="agreements">
                <label class="check-label">
                    <input type="checkbox" name="voorwaarden" value="1" required>
                    Ik ga akkoord met de <a href="#" target="_blank">Algemene Voorwaarden</a>
                </label>
                <label class="check-label">
                    <input type="checkbox" name="nieuwsbrief" value="1">
                    Ja, houd mij op de hoogte via de nieuwsbrief
                </label>
            </div>

            <div class="step-actions">
                <button type="button" class="btn-prev" onclick="goStep(2)">&larr; Terug</button>
                <button type="submit" class="btn-submit">Account aanmaken</button>
            </div>
        </div>

    </form>

    <p class="login-prompt">Al een account? <a href="/inlogportaal">Inloggen</a></p>

</div><!-- /reg-card -->

<footer>
    <p>
        <a href="/">Selectworks.nl</a> | Alle rechten voorbehouden &copy;
        <b>2018 – <?php echo date("Y"); ?></b> |
        Website ontwikkeld door: <a href="https://rapprecht.nl"><b>J.M. Rapprecht</b></a>
    </p>
</footer>

<!-- Step navigation script -->
<script>
function goStep(n) {
    document.querySelectorAll('.form-step').forEach(function(el){ el.classList.remove('active'); });
    document.querySelectorAll('.step').forEach(function(el){
        el.classList.remove('active');
        if (parseInt(el.dataset.step) <= n) el.classList.add('active');
    });
    document.getElementById('step-' + n).classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

</body>
</html>