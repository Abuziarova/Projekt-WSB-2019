<?php session_start();
if(isset($_POST['email']))
{
  $rejestracja=true;
  $nick=$_POST['nick'];
  $haslo1=$_POST['pass1'];
  $haslo2=$_POST['pass2'];
  if($haslo1!=$haslo2)
  {$rejestracja=false;
   $_SESSION['haslo_blad']="Hasła się róznią!!!";
  }

  $haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
  echo $haslo_hash; exit();

  if ($rejestracja==true){echo "walidacji udana";exit();}
}



?>

<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Załóż konto</title>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form  method="post">
      Nickname: <br> <input type="text" name="nick" maxlength="20" pattern="[A-Za-z0-9]+" title="nick może się składać tylko z liter i cyfr. Nie używaj polskich znaków." required> <br>
      E-mail: <br> <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required> <br>
      Hasło: <br> <input type="password" name="pass1" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}" title="minimum 8 znakow, minimum 1 duza litera, minimum 1 mala litera, minimum 1 cyfra" required> <br>
<?php
if(isset($_SESSION['haslo_blad']))
{
   echo '<div class="error">'.$_SESSION['haslo_blad'].'</div>';
   unset($_SESSION['haslo_blad']);
 }

 ?>

      Powtórz hasło: <br> <input type="password" name="pass2" required> <br>
      <input type="checkbox" name="regulamin" required> Akceptuje regulamin

      <div class="g-recaptcha" data-sitekey="your_site_key"></div> <br>

      <input type="submit" name="" value="zarejestruj się">

    </form>
  </body>
</html>
