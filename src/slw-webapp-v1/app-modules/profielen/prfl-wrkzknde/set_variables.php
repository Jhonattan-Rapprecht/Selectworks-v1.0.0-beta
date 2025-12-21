<?php 

  session_start(); // start the session in order to be able to save session variables
  header('refresh:3; url = profielpagina.php'); // refresh the page after 3 seconds

 ?>

<?php 

  // set the session variables

  $_SESSION['name'] = "Jhonattan Rapprecht";
  $_SESSION['age'] = 34;
  $_SESSION['email'] ="jhonattan.rapprecht@gmail.com" ;
  $_SESSION['bio'] ="<i>Ik kom uit de Dominikaanse Republiek en ik woon al sinds ik 2 jaar ben in Nederland. Mijn hobbies zijn schaken, programmeren en gamen.</i>";

echo "Sessie variabelen worden geinitialiseerd.. u word naar de profielpagina omgeleid over: 3 seconden";

  
?>

