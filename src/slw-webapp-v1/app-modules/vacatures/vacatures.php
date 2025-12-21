<!DOCTYPE html>
  
  <html>

    <head>
    
    
    <meta charset="utf-8">
			
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="Project: SelectWorks.nl" content="">

<meta name="Jhonattan M. Rapprecht" content="">
			
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alex+Brush" >

<link rel="icon" type="image/png" href="icons/Selectworks-type2.png">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <title>SelectWorks.nl - Vacaturepagina</title>

      <link rel="stylesheet" type="text/css" href="vacatures-style.css">

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

			
					<li><a href="/selectworks/#"><-- Terug naar Selectworks.nl</a></li>
					<li class="active"><a href="vacatures.php">Vacatures</a></li>
          
 
      	</ul>

		<ul class="nav navbar-nav navbar-right">
		
      <li><a href="../inschrijven/inschrijfformulier.php"><span class="glyphicon glyphicon-user"></span> Inschrijven</a></li>
      <li><a href="../inloggen/inlog-portaal.php"><span class="glyphicon glyphicon-log-in"></span> Inloggen</a></li>
      
   	</ul>
  
	</div>

</nav>

</div>

<div class="page-header">
								
								<p> <a href="/selectworks/"><img style="width:350px;height:auto;" src="/selectworks/slw-webapp-v1/app-data/media/logos/Selectworks-type1-barebones2.png" alt="selectworks-home"></a> </p>
								
</div>

<br>
<br>



<br>
<br>
<br>
<br>


	<div class="main-content">
   
       <div class="paginatitel">

         <h1>Vacatures</h1>

       </div>
       
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

       <div class="column-left">
  
         <ul>
            
            <li><a href="" >Amsterdam</a></li>
     			<li><a href="" >Rotterdam</a></li>
     			<li><a href="" >Utrecht</a></li>
     			<li><a href="" >Den Haag</a></li>
			     			          
     			     			               			          
   		</ul>
  
  	    </div>
  	    
 
    <div class="vacancy-post-1">


      <img src="" alt="Afbeelding bedrijf">
  
      <H2>Titel</H2>
  
      <p>Vacature omschrijving</p>
  
      <p>Knoppen: Contact, Soliciteren knop</p>
  

    </div>
    
    
<?php 
    
    
    $y = 11;
    
      for($x=1;$x<$y;$x++) {
      	
      	  
      	   echo '<div class="vacancy-post">';
      	   echo '<p><img src="" alt="Afbeelding bedrijf" class="border" style="background-color: #FFFFFF"></p>';
      	   //echo '<p class="border" style="background-color: #FFFFFF"><b>Dit is vacature nummer:</b>'.$x.'</p>';
      	   echo '<H2 class="border" style="background-color: #FFFFFF">Titel / Dit is vacature nummer:'.$x.'</p></H2>';
      	   echo '<p class="border" style="background-color: #FFFFFF">Vacature omschrijving Suspendisse potenti. Duis condimentum tempus velit condimentum scelerisque. Morbi urna ante, porttitor non
      	   			 turpis non, convallis lacinia magna. Aenean
      	            maximus lacus nisi, at rutrum dui molestie malesuada. Vivamus sed dui in felis vehicula pellentesque. Donec volutpat hendrerit lorem. Interdum et malesuada fames ac ante ipsum
      	            primis in faucibus. Aenean molestie arcu quis libero iaculis consectetur. Praesent maximus sapien ut eros pellentesque accumsan. In porttitor malesuada sem non scelerisque.
      	            Praesent convallis neque nec auctor porta. Pellentesque efficitur felis et odio cursus, eu pharetra ligula lacinia. Vivamus tincidunt euismod tellus porttitor suscipit. Nullam
      	            varius ultricies pellentesque.</p>';
      	   echo '<p class="border" style="background-color: #FFFFFF">Knoppen: Contact, Soliciteren knop</p>';
      	   echo '</div>';
      	   

} 

?>
    
  <div class="clear"></div>

</div>

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

<!-- FOOTER -->
<footer>
 
          
        <p style="text-align:center;"><a href="#"> Privacy </a> <a href="#">Algemene voorwaarden</a> <a href="#">Ons team</a> <a href="#">Wat wij doen?</a> <a href="#">Werken bij ons</a> <a href="#">Contact</a></p>
        
        <p style="text-align:center;">&copy; <b>2018 -<?php echo " ".date("Y")." ";?></b>Selectworks.nl  Website ontwikkeld door: <a href="http://codeflowers.nl"><b>codeflowers.nl</b></a></p>
        
        <!-- <p class="pull-right"><a href="#">Terug naar boven</a></p>-->

</footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    

</body>
</html>

