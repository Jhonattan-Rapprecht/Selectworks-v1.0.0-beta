
<?php include '../../app-db/dbcon.php'; ?>
	
<?php 
	
	echo "<p> Dit is de pagina waar leden terechtkomen nadat ze op de registreer knop hebben gedrukt <p>"
	
?>
	
<?php
	
	// define variables and set to empty values
	
	$voorletters = $achternaam = $geboortedatum = $geslacht = $straatnaam = $huisnummer_toevoeging = $postcode = $woonplaats = $telefoonnummer =
	$email = $wachtwoord = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  	
	  	
	$voorletters = test_input($_POST["voorletters"]);
	$achternaam = test_input($_POST["achternaam"]);
	$geboortedatum = test_input($_POST["geboortedatum"]);
	$geslacht = test_input($_POST["geslacht"]);
	$straatnaam = test_input($_POST["straatnaam"]);
	$huisnummer_toevoeging = test_input($_POST["huisnummer_toevoeging"]);
	$postcode = test_input($_POST["postcode"]);
	$woonplaats = test_input($_POST["woonplaats"]);
	$telnr = test_input($_POST["telnr"]);
	$email = test_input($_POST["email"]);
	$wachtwoord = test_input($_POST["wachtwoord"]);
	  
	  
	}
	
	function test_input($data) {
	  	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	  
	}
	
	$sql = "INSERT INTO kandidaten (Voorletters, Email, Wachtwoord)
	VALUES ('$voorletters','$email','$wachtwoord')";
	
	if ($conn->query($sql) === TRUE) {
	echo "Nieuwe data is opgeslagen in de database.";
	
	} else {
	 
	echo "Error: " . $sql . "<br>" . $conn->error;
	  
	}
	
	$conn->close();
	
	
	?>
	
	
<?php
	
	echo "<h2>Your Input:</h2>";
	echo $voorletters;
	echo "<br>";
	echo $achternaam;
	echo "<br>";
	echo $geboortedatum;
	echo "<br>";
	echo $geslacht;
	echo "<br>";
	echo $straatnaam;
	echo "<br>";
	echo $huisnummer_toevoeging;
	echo "<br>";
	echo $postcode;
	echo "<br>";
	echo $woonplaats;
	echo "<br>";
	echo $telnr;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $wachtwoord;
	
?>
