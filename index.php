<?php session_start();
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{header("Location: ./nauka.php");
  exit();
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stronka</title>
    <link rel="stylesheet" href="./plik1.css">
  </head>
  <body>

    <form class="" action="./login.php" method="post">
      <p>Login:</p><input type="text" name="login" pattern="[A-Za-z0-9]+" title="Używaj tylko litery i cyfry!" >
      <p>Password:</p><input type="password" name="haslo" ><br><br>
      <?php
   if(isset($_SESSION['blad']))
      echo $_SESSION['blad']; ?><br>


      <input type="submit" name="" value="Sign in">
      <hr>
    <a href="rejestracja.php">Załóż konto!</a>


   </form>


    <h1>English for IT</h1>

  </body>
</html>
