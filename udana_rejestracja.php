<?php

session_start();
if(!isset($_SESSION['udana_rejestracja']))
{
  header("Location: ./index.php");
  exit();
}
else {
  unset($_SESSION['udana_rejestracja']);
}

 ?>

 <!DOCTYPE html>
 <html lang="pl" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Udana rejestracja</title>
     <link rel="stylesheet" href="./udana_rejestracja.css">
   </head>
   <body>
     <div class="container">
        <h1>Dziękujemy za rejestracje!</h1>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Covered+By+Your+Grace" />
         <h2>Teraz możesz rozpocząć naukę języka! </h2>
         <center><img src="./img/okejka.jpg" align="middle"</img></center><br><br>
         <center><a href="./index.php" >Powrót do loginu</a></center>
       </div>
   </body>
 </html>
