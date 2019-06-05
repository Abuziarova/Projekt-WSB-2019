<?php session_start();
if(isset($_POST['email']))
{
  $rejestracja=true;
  $nick=$_POST['nick'];

  if (ctype_alnum($nick)==false)
  		{
  			$wszystko_OK=false;
  			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
  		}
  $e_mail=$_POST['email'];
  $emailB = filter_var($e_mail, FILTER_SANITIZE_EMAIL);

  		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
  		{
  			$wszystko_OK=false;
  			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
  		}


  $haslo1=$_POST['pass1'];
  $haslo2=$_POST['pass2'];


  if($haslo1!=$haslo2)
  {$rejestracja=false;
   $_SESSION['haslo_blad']="Hasła się róznią!!!";
  }
  $haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);

  if (!isset($_POST['regulamin']))
  		{
  			$wszystko_OK=false;
  			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
  		}


  require_once"./connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);

  try{
        $polaczenie=mysqli_connect($host,$db_user,$db_password,$db_name);
        if(mysqli_connect_errno($polaczenie)!=0)
        {
          throw new Exception(mysqli_connect_errno());

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
              header('location: ./udana_rejestracja.php');
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



}

?>

<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Załóż konto</title>


<link rel="stylesheet" href="./plik2.css">
  </head>
  <body>
    <form  method="post">
      Login: <br> <input type="text" name="nick" maxlength="20" > <br>
      <?php
      if(isset($_SESSION['e_nick']))
      {
         echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
         unset($_SESSION['e_nick']);
       }
       ?>

      Hasło: <br> <input type="password" name="pass1" > <br>
        <?php
        if(isset($_SESSION['haslo_blad']))
        {
           echo '<div class="error">'.$_SESSION['haslo_blad'].'</div>';
           unset($_SESSION['haslo_blad']);
         }

         ?>

      Powtórz hasło: <br> <input type="password" name="pass2" > <br>

      E-mail: <br> <input type="text" name="email" > <br>
        <?php
        if(isset($_SESSION['e_email']))
        {
           echo '<div class="error">'.$_SESSION['e_email'].'</div>';
           unset($_SESSION['e_email']);
         }

         ?>
      <input type="checkbox" name="regulamin" required> Akceptuje regulamin <br>



      <input type="submit" name="" value="zarejestruj się">

    </form>
  </body>
</html>