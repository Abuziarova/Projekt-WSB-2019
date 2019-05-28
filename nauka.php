<?php session_start();
if(!isset($_SESSION['zalogowany']))
{
header("Location: ./index.php");
exit();  
}
?>


<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php


echo "<p>Cześć,".$_SESSION['user']."!";
echo "<p> Uczysz się już ".$_SESSION['liczba_dni']." dni!";
unset($_SESSION['blad']);
     ?>
<a href="./logout.php">Wyloguj się!</a>

  </body>
</html>
