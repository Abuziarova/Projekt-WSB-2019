<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona logowania</title>
  </head>
  <body>

<?php

require_once "./connect.php";


if($polaczenie=mysqli_connect($host,$db_user,$db_password,$db_name))
{
  $login1 = $_POST['login'];
  $haslo1 = $_POST['haslo'];

  $sql="select * from users where login = '$login1' and haslo='$haslo1'";
    if($wynik = mysqli_query($polaczenie,$sql))
    {
      $row_count = mysqli_num_rows($wynik);

      if($row_count>0)
      {$wiersz=mysqli_fetch_assoc($wynik);
      $user= $wiersz['imie'];

      mysqli_free_result($wynik);
        header("Location: ./nauka.php");

      
      }
      else { echo "uzytkownik nie istnieje";}

    }
    else{echo "nie prawidłowe zapytanie";}


mysqli_close($polaczenie);
}
else{echo "błąd połączenia z bazą" . mysqli_connect_error();}


 // {echo "połączenie z serwerem,";}
 // else{echo "błąb połaczenia z serwerem";}
 //
 // if(mysqli_select_db($polaczenie,'uzytkownicy'))
 // {echo 'połączenie z bazą uzytkownicy';}
 // else{echo "błąd połaczenia z bazą uzytkownicy;";}
 //
 // $sql = "SELECT `imie` FROM `users` WHERE `login`=\'kot\'";
 //
 // if($wynik = mysqli_query($polaczenie,$sql))
 // {echo "Cześć, ", $wynik;}
 // else {echo "błędne zapytanie";}


 ?>



  </body>
</html>
