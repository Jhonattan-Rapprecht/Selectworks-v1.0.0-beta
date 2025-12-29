<?php

      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			
		  // header('refresh:2;url = /index.php');

			// Report all errors
			error_reporting(E_ALL);
    	ini_set("display_errors", 1);

		  echo $_SERVER['PHP_SELF'];
		  echo "<br>";
      echo $_SERVER['SERVER_NAME'];
      echo "<br>";
			echo $_SERVER['HTTP_HOST'];
			echo "<br>";
			echo $_SERVER['HTTP_REFERER'];
			echo "<br>";
			echo $_SERVER['HTTP_USER_AGENT'];
			echo "<br>";
			echo $_SERVER['SCRIPT_NAME'];
			echo "<br>";
		  echo $_SERVER['DOCUMENT_ROOT'];
			echo "<br>";
			echo "<br>";
		  echo "Dit is het volledige pad van het script dat nu wordt uitgevoerd: "."<b>".$_SERVER['PHP_SELF']."</b>";
      echo "<br>";
      echo "U wordt over circa 3 seconden omgeleid naar het inlogportaal... zoniet, klik dan <a href=\"/slw-webapp-v1/app-modules/inloggen/inlog-portaal.php\">hier</a>";

?>