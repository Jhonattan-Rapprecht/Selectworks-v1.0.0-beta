<?php session_start(); ?>


<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">
			
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="Project: SelectWorks.nl" content="">

<meta name="Jhonattan M. Rapprecht" content="">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alex+Brush" >

<link rel="stylesheet" href="inschrijven.css" >


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<title> <?php echo "SelectWorks.nl | Arbeidsbemiddeling | Dienstverlening | Automatisering | Advies</title>";?>

</head>


<body>

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

			
			<li><a href="../werkgevers/werkgevers.php">Voor werkgevers</a></li>
			<li><a href="../vacatures/vacatures.php">Vacatures</a></li>
			
          
 
      	</ul>




		<ul class="nav navbar-nav navbar-right">
		
      <li class="active"><a href=""><span class="glyphicon glyphicon-user"></span> Inschrijven</a></li>
      <li><a href="../inloggen/inlog-portaal.php"><span class="glyphicon glyphicon-log-in"></span> Inloggen</a></li>
      
   	</ul>
  
	</div>

</nav>

</div>

<div class="page-header">
								
								<p> <a href="http://www.selectworks.nl"><img style="width:350px;height:auto;" src="/slw-webapp-v1/app-data/media/logos/Selectworks-type1-barebones2.png" alt="selectworks-home"></a> </p>
								
</div>


<div class="form-container">

<form class="form-horizontal" action='inschrijving-verwerken.php' method="POST">

  <fieldset>

    <div id="legend" style="text-align: center;">
      <legend class="form-title">Inschrijfformulier / Registratie</legend>
    </div>
    
    
   <div class="persinfo">    
    
    <h2>Persoonlijke Informatie</h2>
    
    <div class="control-group">
      <!-- Voorletters -->
      <label class="control-label"  for="Voorletters">Voorletters:</label>
      <div class="controls">
        <input type="text" id="Voorletters" name="voorletters" placeholder="" class="input-xlarge">
        <p class="help-block">Voorletters mag alleen letters bevatten</p>
      </div>
    </div>
 
<div class="control-group">
      <!-- Achternaam -->
      <label class="control-label"  for="Achteraam">Achternaam:</label>
      <div class="controls">
        <input type="text" id="Achternaam" name="achternaam" placeholder="" class="input-xlarge">
        <p class="help-block">Achternaam mag alleen letters bevatten</p>
      </div>
    </div> 

<div class="control-group">
      <!-- Geboortedatum -->
      <label class="control-label"  for="Geboortedatum">Geboortedatum:</label>
      <div class="controls">
        <input type="text" id="Geboortedatum" name="geboortedatum" placeholder="" class="input-xlarge">
        <p class="help-block">Voer uw geboortedatum in (dd-mm-jjjj)</p>
      </div>
    </div> 
 
 <div class="control-group">
      <!-- Geslacht -->
      <label class="control-label"  for="Geslacht">Geslacht:</label>
      <div class="controls">
        <input type="radio" id="Geslacht-m" name="geslacht" value="man" checked> Man<br>
        <input type="radio" id="Geslacht-v" name="geslacht" value="vrouw"> Vrouw<br>
      </div>
    </div> 
 
</div>


<div class="adresinfo">
 
 <h2>Adresgegevens</h2>
 
<div class="control-group">
      <!-- straatnaam -->
      <label class="control-label"  for="Straatnaam">Straatnaam:</label>
      <div class="controls">
        <input type="text" id="Straatnaam" name="straatnaam" placeholder="" class="input-xlarge">
        <p class="help-block">Voer uw straatnaam in</p>
      </div>
    </div> 
 
<div class="control-group">
      <!--Huisnummer + toevoeging-->
      <label class="control-label"  for="Huisnummer_toevoeging">Huisnummer + toevoeging:</label>
      <div class="controls">
        <input type="text" id="Huisnummer_toevoeging" name="huisnummer_toevoeging" placeholder="" class="input-xlarge">
        <p class="help-block">Voer uw huisnummer in en evt. toevoeging</p>
      </div>
    </div> 

<div class="control-group">
      <!--Postcode-->
      <label class="control-label"  for="Postcode">Postcode:</label>
      <div class="controls">
        <input type="text" id="Postcode" name="postcode" placeholder="" class="input-xlarge">
        <p class="help-block">Voer uw Postcode in (bijv: 4321 AB)</p>
      </div>
    </div> 
    
 <div class="control-group">
      <!--woonplaats-->
      <label class="control-label"  for="Woonplaats">Woonplaats:</label>
      <div class="controls">
        <input type="text" id="Woonplaats" name="woonplaats" placeholder="" class="input-xlarge">
        <p class="help-block">Voer uw Woonplaats in</p>
      </div>
    </div> 
 </div>
 
 <div class="continfo">
 
<h2>Contactgegevens</h2> 
 
 <div class="control-group">
      <!-- Telefoonnummer -->
      <label class="control-label" for="email">Telefoonnummer:</label>
      <div class="controls">
        <input type="text" id="telnr" name="telnr" placeholder="" class="input-xlarge">
        <p class="help-block">Voer uw telefoon nummer in</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        <p class="help-block">Voer uw email adres in</p>
      </div>
    </div>

</div>
 
 
 <div class="inloginfo">
 
 <h2>Inloggegevens</h2>
    <div class="control-group">
      <!-- Wachtwoord-->
      <label class="control-label" for="password">Wachtwoord</label>
      <div class="controls">
        <input type="password" id="password" name="wachtwoord" placeholder="" class="input-xlarge">
        <p class="help-block">Het wachtwoord moet minimaal 4 karakters lang zijn</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Wachtwoord -->
      <label class="control-label"  for="password_confirm">Wachtwoord (Herhaal)</label>
      <div class="controls">
        <input type="password" id="password_repeat" name="wachtwoord_herhaal" placeholder="" class="input-xlarge">
        <p class="help-block">Herhaal uw wachtwoord</p>
      </div>
    </div>
 
 
 
<br> 
<br>

    </div>
        

    



<div class="submitinfo">

    <div class="submitbutton">
      <!-- Button -->
      
      <div class="controls">
        
        <button type="submit" class="btn btn-success">Inschrijven</button>
        
        <br>
        <br>
        
        <input type="checkbox" name="checkbox1" value=""> Ik ga akkoord met de <a href="">Algemene Voorwaarden</a><br>

        <input type="checkbox" name="checkbox2" value=""> Ja, ik wil graag op de hoogte gehouden worden via de nieuwsbrief<br>

         </div>

        </div>

      </div>
      
  </fieldset>
  
  </form>

</div>

<?php include '/slw-webapp-v1/app-includes/footer/footer.php' ?>



</body>

</html>