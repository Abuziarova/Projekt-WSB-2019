<?php session_start();
if(isset($_GET['activate']))
{$_SESSION['udana_rejestracja']=true;

header("location: ./udana_rejestracja.php");
exit();
}

if(isset($_POST['email']))
{
  $rejestracja=true;
  $nick=$_POST['nick'];
// czy login jest poprawny
  if (ctype_alnum($nick)==false)
  {
  $rejestracja=false;
  $_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
  }
// czy email jest poprawny
  $e_mail=$_POST['email'];
  $emailB = filter_var($e_mail, FILTER_SANITIZE_EMAIL);
  if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$e_mail))
  {
  $rejestracja=false;
  $_SESSION['e_email']="Podaj poprawny adres e-mail!";
  }
// czy hasła są identyczne
  $haslo1=$_POST['pass1'];
  $haslo2=$_POST['pass2'];
  if($haslo1!=$haslo2)
  {$rejestracja=false;
   $_SESSION['haslo_blad']="Hasła się róznią!!!";
  }
  $haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
// akceptacja regulaminu
  if (!isset($_POST['regulamin']))
  {
  $rejestracja=false;
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
            //sprawdzamy czy istnieje już konto,przywiązane do tego e-maila
          $wynik = mysqli_query($polaczenie,"select id from users where email='$e_mail'");
          if(!$wynik)throw new Exception(mysqli_connect_error($polaczenie));
          $ilosc_email=mysqli_num_rows($wynik);
          if($ilosc_email>0)
          {$rejestracja=false;
           $_SESSION['e_email']="Już istnieje konto,przywiązane do tego e-maila";
          }

            //sprawdzamy czy ten nick nie jest już zajęty
          $wynik = mysqli_query($polaczenie,"select id from users where login='$nick'");
          if(!$wynik)throw new Exception(mysqli_connect_error($polaczenie));
          $ilosc_nick=mysqli_num_rows($wynik);
          if($ilosc_nick>0)
          {$rejestracja=false;
           $_SESSION['e_nick']="Ten nick już jest zajęty.Wybierz inny.";
          }
          // nie wykryto błędów -> dodajemy użytkownika do bazy
          if ($rejestracja==true)
          {
            if(mysqli_query($polaczenie,"insert into users values(null,'$nick','$haslo_hash','$e_mail',0)"))
            {

              $email_template="./activate.html";
              $wiadomosc=file_get_contents($email_template);
              $wiadomosc=str_replace("[login]",$nick,$wiadomosc);
              $wiadomosc=str_replace("[key]",$haslo_hash,$wiadomosc);
              $wiadomosc=str_replace("[url]","http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'],$wiadomosc);
              $naglowek='From: julia@firstprojekt.cba.pl' . "\r\n" .
              'Reply-To: julia@firstprojekt.cba.pl' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

              // wysyłamy maila
            if(mail($e_mail,"Aktywacja konta dla ".$nick,$wiadomosc,$naglowek))
            {  echo '<link rel="Stylesheet" type="text/css" href="./plik2.css" />';
            echo "'<h1>Wiadomość z kluczem aktywacyjnym została wysłana</h1>'";
            exit();
            }
            else {
              echo "błąd wysyłania maila";
              exit();
                 }
            }
            else
            {
              throw new Exception($polaczenie->error);
            }

          }
          mysqli_close($polaczenie);
        }
    }
  catch(Exception $error)
{
      echo "Błąd serwera!";
      echo $error;
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
    <div class="title"><h1>Załóż konto</h1></div>
    <div class="container">
        <div class="formbox">
            <form  method="post">
            <p>Login:</p>
            <input type="text" name="nick" maxlength="20" >
                <?php
                    if(isset($_SESSION['e_nick']))
                    {
                    echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                    unset($_SESSION['e_nick']);
                    }
                ?>
            <p>Hasło:</p>
            <input type="password" name="pass1" >
                <?php
                    if(isset($_SESSION['haslo_blad']))
                    {
                    echo '<div class="error">'.$_SESSION['haslo_blad'].'</div>';
                    unset($_SESSION['haslo_blad']);
                    }
                ?>
            <p>Powtórz hasło:</p> <br>
            <input type="password" name="pass2" >
            <p>E-mail:</p>
            <input type="text" name="email" > <br>
                <?php
                    if(isset($_SESSION['e_email']))
                    {
                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
                    }
                ?>
            <p>Akceptuje regulamin</p>
            <input type="checkbox" name="regulamin">
                <?php
                    if(isset($_SESSION['e_regulamin']))
                    {
                    echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                    unset($_SESSION['e_regulamin']);
                    }
                ?>
            <input type="submit" name="" value="zarejestruj się">
            </form>
        </div>
    </div>
  </body>
</html>
