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
    <link rel="stylesheet" href="./plik1.css">
    <title>English for IT</title>
    <link rel="stylesheet" href="./plik1.css" ss>
  </head>
  <body>
    <div class="title"><h1>English for IT</h1></div>
    <div class="container">
    <div class="left"></div>
    <div class="right">
      <div class="formbox">
        <form class="" action="./login.php" method="post">
          <p>Login:</p>
          <input type="text" name="login" pattern="[A-Za-z0-9]+" placeholder="login" title="Używaj tylko litery i cyfry!">
          <p>Hasło:</p>
          <input type="password" name="haslo" placeholder="hasło">
            <?php
            if(isset($_SESSION['blad']))
            echo $_SESSION['blad'];
            ?>
          <input type="submit" name="" value="Zaloguj się">
          <a href="rejestracja.php">Załóż konto</a>
        </form>
      </div>
     </div>
    </div>



  </body>
</html>
