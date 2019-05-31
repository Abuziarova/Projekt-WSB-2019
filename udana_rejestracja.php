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
     <title></title>
   </head>
   <body>
     <h1>Dziękujemy za rejestracje!</h1>
     <h2>Możesz się zalogować na swoje konto </h2> <a href="./index.php">tutaj</a>
   </body>
 </html>
