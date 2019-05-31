<?php session_start();
if(isset($_POST['email']))
{
  $rejestracja=true;
  $nick=$_POST['nick'];
  $haslo1=$_POST['pass1'];
  $haslo2=$_POST['pass2'];
  $e_mail=$_POST['email'];
  if($haslo1!=$haslo2)
  {$rejestracja=false;
   $_SESSION['haslo_blad']="Hasła się róznią!!!";
  }

  $haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);

  require_once"./connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);

  try{
        $polaczenie=mysqli_connect($host,$db_user,$db_password,$db_name);
        if(mysqli_connect_errno($polaczenie)!=0)
        {
          throw new \Exception(mysqli_connect_errno());

        }
        else
        {

          $wynik = mysqli_query($polaczenie,"select id from users where email='$e_mail'");
          if(!$wynik)throw new Exception(mysqli_connect_error($polaczenie));
          $ilosc_email=mysqli_num_rows($wynik);
          if($ilosc_email>0)
          {$rejestracja=false;
           $_SESSION['e_email']="Już istnieje konto,przywiązane do tego e-maila";
          }


          $wynik = mysqli_query($polaczenie,"select id from users where login='$nick'");
          if(!$wynik)throw new Exception(mysqli_connect_error($polaczenie));
          $ilosc_nick=mysqli_num_rows($wynik);
          if($ilosc_nick>0)
          {$rejestracja=false;
           $_SESSION['e_nick']="Ten nick już jest zajęty.Wybierz inny.";
          }

          if ($rejestracja==true)
          {
            if(mysqli_query($polaczenie,"insert into users values(null,'$nick','$haslo_hash','$e_mail',0)"))
            {
              $_SESSION['udana_rejestracja']==true;
              header("Location: ./udana_rejestracja.php");
            }
            else
            {
              throw new Exception(mysqli_connect_error($polaczenie));
            }

          }
          mysqli_close($polaczenie);
        }
    }
  catch(Exception $error)
{
      echo "Błąd serwera!";
      exit();

  }

/*  $sekret = "6LftVaYUAAAAAIVz17e8TG3xIXFkbko9hridOu2E";
  $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&responce='.$_POST['g-recaptcha-response']);
  $odp=json_decode($sprawdz);

  if($odp->success){echo "jest ok!";}
  else
  {$rejestracja=false;
   $_SESSION['e_bot']="Potwierdź że jesteś człowiekiem";

  }
*/

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
      Imie

      Login: <br> <input type="text" name="nick" maxlength="20" pattern="[A-Za-z0-9]+" title="nick może się składać tylko z liter i cyfr. Nie używaj polskich znaków." required> <br>
      <?php
      if(isset($_SESSION['e_nick']))
      {
         echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
         unset($_SESSION['nick']);
       }
       ?>

      Hasło: <br> <input type="password" name="pass1" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}" title="minimum 8 znakow, minimum 1 duza litera, minimum 1 mala litera, minimum 1 cyfra" required> <br>
        <?php
        if(isset($_SESSION['haslo_blad']))
        {
           echo '<div class="error">'.$_SESSION['haslo_blad'].'</div>';
           unset($_SESSION['haslo_blad']);
         }

         ?>

      Powtórz hasło: <br> <input type="password" name="pass2" required> <br>

      E-mail: <br> <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required> <br>
        <?php
        if(isset($_SESSION['e_email']))
        {
           echo '<div class="error">'.$_SESSION['e_email'].'</div>';
           unset($_SESSION['e_email']);
         }

         ?>
      <input type="checkbox" name="regulamin" required> Akceptuje regulamin <br>

    <!-- <div class="g-recaptcha" data-sitekey="6LftVaYUAAAAAHmsR6DBJCurAOjQ0XeSIBNQyZZS"></div> <br> -->
      <?php
    /*    if(isset($_SESSION['e_bot']))
      {
         echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
         unset($_SESSION['e_bot']);
       }
*/
       ?>

      <input type="submit" name="" value="zarejestruj się">

    </form>
  </body>
</html>
