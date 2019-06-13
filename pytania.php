<?php session_start();
if(!isset($_SESSION['zalogowany']))
{
header("Location: ./index.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>właśnie nauka</title>
  </head>
  <body>
    <form class="" action="pytania.php" method="post">


<?php
$imie=$_SESSION['user'];

require_once "./connect.php";
if($polaczenie=mysqli_connect($host,$db_user,$db_password,$db_name))
{
    mysqli_set_charset($polaczenie, 'utf8');

    $losowa=rand(0,20);

    if(!isset($_SESSION['prawidlowe']))
        {
        $id_pytania=$losowa;
        $_SESSION['id']=$id_pytania;
        $_SESSION['ile_prawidlowych']=0;
      }else {
        $id_pytania=$_SESSION['id'];
      }

      if(isset($_POST['next']))
      {
        $id_pytania=$losowa;
        $_SESSION['id']=$id_pytania;
        unset($_POST['next']);
      }

    if(!isset($_POST['ques']))
    {$_SESSION['prawidlowe']=false;
     $_SESSION['niezaznaczone']="Zaznacz jedną z odpowiedzi:";
    }

    $sql = "SELECT * FROM pytania WHERE id='$id_pytania'";

    $rezultat = mysqli_query($polaczenie, $sql);
    $wiersz = mysqli_fetch_assoc($rezultat);

    if((isset($_POST['ques']))&& ($_POST['ques']!=$wiersz['answer']))
        { $_SESSION['prawidlowe']=false;
          $_SESSION['nieprawidlowe']="Odpowieź nieprawidłowa";
          $_SESSION['id']=$id_pytania;
        }
        else   if((isset($_POST['ques']))&&($_POST['ques']=$wiersz['answer']))
        { $_SESSION['prawidlowe']=true;
          $_SESSION['brawo']="Prawidłowa odpowiedź!";
          $_SESSION['id']=$id_pytania;
          $_SESSION['ile_prawidlowych']++;
        }

  echo  '<h2>'.$wiersz['tresc'].'</h2> <br> ';
  if(isset( $_SESSION['nieprawidlowe']))
  {
    echo $_SESSION['nieprawidlowe'];
    unset($_SESSION['nieprawidlowe']);
  }
  if(isset( $_SESSION['brawo']))
  {
    echo $_SESSION['brawo'];
    unset($_SESSION['brawo']);
  }
  if($_SESSION['ile_prawidlowych']==5)
  {
    $sql2 = "update users SET liczba_dni=liczba_dni+1 WHERE login='$imie'";
    if(mysqli_query($polaczenie, $sql2))
    {
      $_SESSION['gratulacje']="GRATULACJE!
      OSIĄGNĘŁEŚ DZIENNY CEL!
      Zaliczyłeś kolejny dzień nauki!";
    }else{echo "Błąd zapitania sql2";}

  }
  if(isset( $_SESSION['niezaznaczone']))
  {
    echo $_SESSION['niezaznaczone'];
    unset($_SESSION['niezaznaczone']);
  }

  echo '<br><input type="radio" name="ques" value="a">'.$wiersz['odpa'];
  echo '<br><input type="radio" name="ques" value="b">'.$wiersz['odpb'];
  echo '<br><input type="radio" name="ques" value="c">'.$wiersz['odpc'];
  echo '<br><input type="radio" name="ques" value="d">'.$wiersz['odpd'];
  echo '<br><br><input type="submit" name="" value="wyslij"><br><br>';

  if((isset ($_SESSION['prawidlowe']))&&( $_SESSION['prawidlowe']==true))
  {
  echo '<input type="submit" name="next" value="następne pytanie"><br><br>';}

  $ile=$_SESSION['ile_prawidlowych'];
  echo "Masz $ile prawidłowych odpowiedzi!";
  if(isset($_SESSION['gratulacje']))
  {
    echo $_SESSION['gratulacje'];
    unset( $_SESSION['gratulacje']);
  }


}

else{echo "Nie ma połączenia z bazą danych";}

?>
<br><br>
<a href="./logout.php"> <input type="button" name="" value="wyloguj"> </a>

</form>
</body>
</html>
