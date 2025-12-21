<?php 

  //session_start(); // start the session in order to be able to save session variables
  header('refresh:3; url = /index.php'); // refresh the page after 3 seconds

 ?>

<!DOCTYPE html>

<html>
<body>

<?php

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();


echo "Sessie variabelen worden vernietigd.. u word omgeleid naar de hoofdpagina, nog: 3 seconden";


?>

</body>
</html>