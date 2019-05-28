<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
header("Location: ./index.php");
exit();
}

require_once "./connect.php";


if($polaczenie=mysqli_connect($host,$db_user,$db_password,$db_name))
{
  $login1 = $_POST['login'];
  $haslo1 = $_POST['haslo'];

  $login1=htmlentities($login1, ENT_QUOTES, "UTF-8");
  $haslo1=htmlentities($haslo1, ENT_QUOTES, "UTF-8");

  $sql="select * from users where login = '$login1' and haslo='$haslo1'";
    if($wynik = mysqli_query($polaczenie,$sql))
    {
      $row_count = mysqli_num_rows($wynik);

      if($row_count>0)
      {$_SESSION['zalogowany']=true;

        $wiersz=mysqli_fetch_assoc($wynik);
        $_SESSION['id']=$wiersz['id'];
        $_SESSION['user']= $wiersz['imie'];
        $_SESSION['liczba_dni']= $wiersz['liczba_dni'];

      mysqli_free_result($wynik);
        header("Location: ./nauka.php");
    }
      else {
        $_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        header("Location: ./index.php");
           }

    }
    else{echo "nie prawidłowe zapytanie";}


mysqli_close($polaczenie);
}
else{echo "błąd połączenia z bazą" . mysqli_connect_error();}




 ?>
