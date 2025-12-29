<?php session_start(); ?>
<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include '../../app-db/dbcon.php';
    
    // Disable/Enable the login module
    
    /*header('Location: /index.php');
    exit;*/
    
    // Check if form inputs are set
		
		if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['wachtwoord'])) {

    $email      = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    
    // Sanitize strings/HTML user inputs before insertion into the database! ..to prevent SQL injection attacks, or "database hijacking"
    
    

    // the MySQL query
    
    $sql = "SELECT * FROM kandidaten where Email='$email' and Wachtwoord='$wachtwoord'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {

    // output data of each row

    while($row = $result->fetch_assoc()) {
       	
    // compare the form input values to the values inside the database  	
    
	    if($email == $row['Email'] && $wachtwoord == $row['Wachtwoord']){
	     	
	      header('refresh:3; url = ../profielen/prfl-wrkzknde/profielpagina.php');
	
	      echo'Klik op de volgende <a href="../profielen/prfl-wrkzknde/profielpagina.php">link</a> om naar uw profielpagina te gaan als u niet automatisch wordt doorgestuurd.';
	
	       
	    }
  
    }
  	   
  } else {
	 	
			   header('refresh:3; url = inlog-portaal.php');
			   
	       echo "Uw gebruikersnaam of wachtwoord is niet juist, probeer het opnieuw.";
	       
	       // remove all session variables
	       
				 session_unset(); 

				 // destroy the session
				 
				 session_destroy();
	 
	   		 $conn->close();
  }		 
}

?>