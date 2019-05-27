<?php session_start(); ?>


<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php


echo "<p>Cześć,".$_SESSION['user']."!";
echo "<p> Uczysz się już ".$_SESSION['liczba_dni']." dni!" ;
unset($_SESSION['blad']);

     ?>
  </body>
</html>
