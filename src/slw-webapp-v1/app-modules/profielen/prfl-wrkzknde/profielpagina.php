<?php session_start(); ?>




<!DOCTYPE html>

  <html>

    <head>

      <meta charset="utf-8" />

        <title>Profiel pagina Selectworks.nl leden</title>

        <link rel="stylesheet" href="profile_style.css">

    </head>




<body>


  <div class="top-navbar">


    <p id="user_greet">Dit is de profielpagina van: 
    
      <?php 
      
        if(isset($_SESSION['name'])){ 
        
        echo "<b>".$_SESSION['name']."</b>";
    
        } else { 
    
        echo "<b>Stranger!</b>";
        
        }
      
      ?>
    
    </p>


    <p id="current_time">

      <?php 

        if(isset($_SESSION['name']) && isset($_SESSION['age']) && isset($_SESSION['email'])){

        echo '<script>function startTime() {
  	
  	           var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              document.getElementById(\'current_time\').innerHTML = "De tijd is: <b>" +
              h + ":" + m + ":" + s + "</b> | <a href=\"unset_variables.php\">Uitloggen</a>";
              var t = setTimeout(startTime, 500);
        
              }

              function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
  
              };

              startTime();
        
              </script> ';
  
        } else {
  	
        echo '<script>function startTime() {
	
              var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              document.getElementById(\'current_time\').innerHTML = "De tijd is: <b>" +
              h + ":" + m + ":" + s + "</b> | <a href=\"set_variables.php\">Inloggen</a>";
              var t = setTimeout(startTime, 500);
        
              }

              function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
  
              };

              startTime();
        
              </script> ';  
              
        }
	
      ?>

    </p>


  </div>




  <div class="header_info">

    <h2 style="text-align: center;">Welkom op jouw profielpagina!</h2>

  </div>




  <div class="wrapper">

    <div class="side_nav"><h3>Navigatie 1</h3></div>

      <div class="box">

        <div class="user_info">

         <img id="profile_picture" src=" /selectworks/slw-webapp-v1/app-data/media/images/Profile images/avatar-default-med.png" alt="Profiel foto" height="" width="">

           <table id="user_data" >
             <tr>
               <th>Naam:</th>
               <td><?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; }?></td>
             </tr>
             <tr>
               <th>Leeftijd:</th>
               <td><?php if(isset($_SESSION['age'])){ echo $_SESSION['age']; }?></td>
             </tr>
             <tr>
               <th>Email:</th>
               <td><?php if(isset($_SESSION['email'])){ echo $_SESSION['email']; }?></td>
             </tr>
             <tr>
               <th>Biografie:</th>
               <td><?php if(isset($_SESSION['bio'])){ echo $_SESSION['bio']; }?></td>
             </tr>
           </table>

        </div>

  <div class="user_work">

    <h3>Werkverleden</h3>

  </div>


  <div class="user_work">

    <h3>Ambities</h3>

  </div>


  <div class="user_work">

    <h3>Korte termijn doelen</h3>

  </div>


  <div class="user_work">

    <h3>Lange termijn doelen</h3>

  </div>


  <div class="user_work">

    <h3>Test text.</h3>

  </div>


  <div class="user_work">

    <h3>Test text.</h3>

  </div>


  <div class="user_work">

    <h3>Test text.</h3>

  </div>


  <div class="user_work">

    <h3>Test text.</h3>

  </div>


  <div class="user_work">

    <h3>Test text.</h3>

  </div>


</div>




  <div class="side_nav_right"><h3>Navigatie 2</h3></div>




</div>




  <div class="footer"></div>


</body>
</html>