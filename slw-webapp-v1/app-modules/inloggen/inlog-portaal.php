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
				
				<link rel="stylesheet" href="inl-prtl.css">
				
				
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

							<li><a href="../../app-page-templates/business/business.php">Voor werkgevers</a></li>
							<li><a href="../vacatures/vacatures.php">Vacatures</a></li>
			
      		</ul>

					<ul class="nav navbar-nav navbar-right">
					
					      <li><a href="../inschrijven/inschrijfformulier.php"><span class="glyphicon glyphicon-user"></span> Inschrijven</a></li>
					      <li class="active"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Inloggen</a></li>
					      
			   	</ul>
  
		</div>

</nav>

</div>

<div class="page-header">
								
<p> <a href="http://www.selectworks.nl"><img style="width:150px;height:70px;" src="/slw-webapp-v1/app-data/media/logos/Selectworks-type1-barebones2.png" alt="selectworks-home"></a> </p>
								
</div>

 <div class="container">

      <form name="inlog-portaal" method="post" action="login-verwerken.php" >
      
      
        <h2 class="form-signin-heading">Leden login </h2>
        
        
        <label for="inputEmail" class="sr-only">Email adres</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="email adres" required autofocus>
        
        <label for="inputPassword" class="sr-only">Wachtwoord</label>
        <input type="password" id="inputPassword" class="form-control" name="wachtwoord" placeholder="wachtwoord" required>
        
        
        <div class="checkbox">
          
          <label>
          
            <input name="radiobuttons" type="checkbox" value="remember-me"> Onthoud mijn computer
            
          </label>
          
        </div>
        
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Log in</button>
        
        
      </form>

    </div> <!-- /container -->

<footer>

<p><a href="http://www.selectworks.nl">Selectworks.nl</a> | Alle rechten voorbehouden &copy; <b>2018 -<?php echo " ".date("Y")." ";?></b> | Website ontwikkeld door: <a href="http://rapprecht.nl"><b>J.M. Rapprecht</b></a></p>

</footer>


</body>

</html>