<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="project" content="SelectWorks.nl">
    <meta name="author" content="Jhonattan M. Rapprecht">

    <title>SelectWorks.nl - Opdrachten</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/slw-webapp-v1/app-data/media/icons/Selectworks-type2.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Alex+Brush">

    <!-- Page Styles -->
    <link rel="stylesheet"
          href="/slw-webapp-v1/app-modules/opdrachten/opdrachten-style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button"
                        class="navbar-toggle"
                        data-toggle="collapse"
                        data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav">
                    <li><a href="/">← Terug naar Selectworks.nl</a></li>
                    <li class="active"><a href="/opdrachten">Opdrachten</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/inschrijven"><span class="glyphicon glyphicon-user"></span> Inschrijven</a></li>
                    <li><a href="/inloggen"><span class="glyphicon glyphicon-log-in"></span> Inloggen</a></li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="page-header text-center" style="margin-top: 80px;">
        <a href="/">
            <img src="/slw-webapp-v1/app-data/media/logos/Selectworks-type1-barebones2.png"
                 alt="selectworks-home"
                 style="width:350px;height:auto;">
        </a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content container">

        <div class="paginatitel text-center">
            <h1>Opdrachten</h1>
        </div>

        <!-- Pagination Top -->
        <div class="center">
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">7</a>
                <a href="#">8</a>
                <a href="#">9</a>
                <a href="#">10</a>
                <a href="#">&raquo;</a>
            </div>
        </div>

        <!-- LEFT COLUMN -->
        <div class="column-left">
            <ul>
                <li><a href="#">Amsterdam</a></li>
                <li><a href="#">Rotterdam</a></li>
                <li><a href="#">Utrecht</a></li>
                <li><a href="#">Den Haag</a></li>
            </ul>
        </div>

        <!-- FIRST VACANCY TEMPLATE -->
        <div class="vacancy-post-1">
            <img src="" alt="Afbeelding bedrijf">
            <h2>Titel</h2>
            <p>Vacature omschrijving</p>
            <p>Knoppen: Contact, Solliciteren knop</p>
        </div>

        <!-- PHP-GENERATED VACANCIES -->
        <?php 
            for ($x = 1; $x <= 10; $x++) {
                echo '
                <div class="vacancy-post">
                    <p>
                        <img src="" alt="Afbeelding bedrijf"
                             class="border"
                             style="background-color:#FFFFFF">
                    </p>
                    <h2 class="border" style="background-color:#FFFFFF">
                        Titel / Dit is vacature nummer: '.$x.'
                    </h2>
                    <p class="border" style="background-color:#FFFFFF">
                        Vacature omschrijving Suspendisse potenti. Duis condimentum tempus velit condimentum scelerisque.
                        Morbi urna ante, porttitor non turpis non, convallis lacinia magna. Aenean maximus lacus nisi,
                        at rutrum dui molestie malesuada. Vivamus sed dui in felis vehicula pellentesque. Donec volutpat
                        hendrerit lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean molestie
                        arcu quis libero iaculis consectetur. Praesent maximus sapien ut eros pellentesque accumsan.
                        In porttitor malesuada sem non scelerisque. Praesent convallis neque nec auctor porta.
                        Pellentesque efficitur felis et odio cursus, eu pharetra ligula lacinia. Vivamus tincidunt
                        euismod tellus porttitor suscipit. Nullam varius ultricies pellentesque.
                    </p>
                    <p class="border" style="background-color:#FFFFFF">
                        Knoppen: Contact, Solliciteren knop
                    </p>
                </div>';
            }
        ?>

        <div class="clear"></div>

        <!-- Pagination Bottom -->
        <div class="center">
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">7</a>
                <a href="#">8</a>
                <a href="#">9</a>
                <a href="#">10</a>
                <a href="#">&raquo;</a>
            </div>
        </div>

    </div> <!-- /.main-content -->

    <!-- FOOTER -->
    <footer class="text-center" style="margin-top:40px;">
        <p>
            <a href="#">Privacy</a> |
            <a href="#">Algemene voorwaarden</a> |
            <a href="#">Ons team</a> |
            <a href="#">Wat wij doen?</a> |
            <a href="#">Werken bij ons</a> |
            <a href="#">Contact</a>
        </p>

        <p>
            &copy; <b>2018 - <?php echo date("Y"); ?></b> Selectworks.nl  
            Website ontwikkeld door:
            <a href="http://codeflowers.nl"><b>codeflowers.nl</b></a>
        </p>
    </footer>

    <!-- JS (jQuery + Bootstrap) at end for performance -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
