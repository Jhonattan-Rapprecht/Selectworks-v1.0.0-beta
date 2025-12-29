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

          <li class="<?= $currentPath === '' ? 'active' : '' ?>">
            <a href="">Selectworks.nl</a>
          </li>

          <li class="<?= $currentPath === 'vacatures' ? 'active' : '' ?>">
            <a href="/vacatures">Vacatures</a>
          </li>

          <li class="<?= $currentPath === 'opdrachten' ? 'active' : '' ?>">
            <a href="/opdrachten">Opdrachten</a>
          </li>

          <li class="<?= $currentPath === 'diensten' ? 'active' : '' ?>">
            <a href="/diensten">Diensten</a>
          </li>

        </ul>

        <ul class="nav navbar-nav navbar-right">

          <li class="<?= $currentPath === 'inschrijven' ? 'active' : '' ?>">
            <a href="/inschrijven">
              <span class="glyphicon glyphicon-user"></span> Inschrijven
            </a>
          </li>

          <li class="<?= $currentPath === 'inloggen' ? 'active' : '' ?>">
            <a href="/inloggen">
              <span class="glyphicon glyphicon-log-in"></span> Inloggen
            </a>
          </li>

        </ul>

      </div>
    </div>
  </nav>

</div>
