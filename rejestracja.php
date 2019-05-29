<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Załóż konto</title>
  </head>
  <body>
    <form  method="post">
      Nickname: <br> <input type="text" name="nick"> <br>
      E-mail: <br> <input type="text" name="email"> <br>
      Hasło: <br> <input type="password" name="pass1"> <br>
      Powtórz hasło: <br> <input type="password" name="pass2"> <br>
      <input type="checkbox" name="regulamin"> Akceptuje regulamin

    </form>
  </body>
</html>
