<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stronka</title>
    <link rel="stylesheet" href="./plik1.css">
  </head>
  <body>

    <form class="" action="./login.php" method="post">
      <p>Login:</p><input type="text" name="login" >
      <p>Password:</p><input type="password" name="haslo" ><br><br>
      <input type="submit" name="" value="Sign in">
      <hr>
      <input type="submit" name="" value="Sign up">
   </form>

   <?php
if(isset($_SESSION['blad']))
   echo $_SESSION['blad']; ?>
    <h1>English for IT</h1>

  </body>
</html>
