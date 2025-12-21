<?php 

$root = $_SERVER['DOCUMENT_ROOT']; 

?>

<!DOCTYPE html>

<html>

	<head>
		
		<!-- Meta tags -->		
		
		<meta charset="utf-8">
					
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="application" content="selectworks-webapplicatie-versie-1.0">
		
		<meta name="author" content="J.M. Rapprecht">
		
		<!-- Stylesheets -->
		
		<link rel="stylesheet" type="text/css" href="//wpcc.io/lib/1.0.2/cookieconsent.min.css"/>
					
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alex+Brush">
		
		<link rel="stylesheet" href="https://www.selectworks.nl/slw-webapp-v1/app-includes/style/css/carousel.css">
		
		<link rel="stylesheet" href="https://www.selectworks.nl/slw-webapp-v1/app-includes/style/css/selectworks-style.css">
		
		<link rel="stylesheet" href="https://www.selectworks.nl/slw-webapp-v1/app-includes/services/services-style.css">
		
		<!-- Stylesheets animations-->
		
		<link rel="stylesheet" href="https://www.selectworks.nl/slw-webapp-v1/app-animations/combined-animations.css">
		
		<link rel="stylesheet" href="https://www.selectworks.nl/slw-webapp-v1/app-animations/loading bars/Preloader-master/preloader.css" >
		
		<!-- Address bar icon / favicon-->
		
		<link rel="icon" type="image/png" href="https://www.selectworks.nl/slw-webapp-v1/app-includes/header/favicon/Selectworks-type2.png">
		
		<title>
		
			<?php echo 'SelectWorks.nl | Arbeidsbemiddeling | Dienstverlening | Automatisering | Advies</title>';?>
			
		</title>
	
	</head>
		
<body id="body">

<?php

				/* Navbar controller script*/
				
				$currentPage = $_SERVER['PHP_SELF'];
				$activePage = '';

				
				/* Include error controller on each page */
				
				include($root.'/selectworks/slw-webapp-v1/app-controllers/error-controller/error-controller.php');

					
				/* Include content panel overlay */
				
				include($root.'/selectworks/slw-webapp-v1/app-includes/content-panels/content-panel-a.php');
				
				
				/* Include the 'SW' text animation */
				
				// include($root.'/selectworks/slw-webapp-v1/app-animations/combined-animations.php');
				
?>