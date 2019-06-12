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
require_once "./connect.php";


if($polaczenie=mysqli_connect($host,$db_user,$db_password,$db_name))
{
  mysqli_set_charset($polaczenie, 'utf8');
  $prawidlowe=true;
  $losowa=rand(0,20);




if($prawidlowe=true)
  $id_pytania=$losowa;
  $sql = "SELECT * FROM pytania WHERE id='$id_pytania'";

  $rezultat = mysqli_query($polaczenie, $sql);
  $wiersz = mysqli_fetch_assoc($rezultat);



  echo  '<h2>'.$wiersz['tresc'].'</h2> <br> ';

  if(isset( $_SESSION['nieprawidlowe']))
  {
    echo $_SESSION['nieprawidlowe'];
    unset($_SESSION['nieprawidlowe']);
  }

  echo '<br><input type="radio" name="ques" value="a">'.$wiersz['odpa'];
  echo '<br><input type="radio" name="ques" value="b">'.$wiersz['odpb'];
  echo '<br><input type="radio" name="ques" value="c">'.$wiersz['odpc'];
  echo '<br><input type="radio" name="ques" value="d">'.$wiersz['odpd'];
  echo '<br><br><input type="submit" name="" value="wyslij">';
  $odp=$_POST['ques'];
  if ($odp!=$wiersz['answer'])
  { $prawidlowe=false;
    $_SESSION['nieprawidlowe']="Odpowieź nieprawidłowa";

  }





}


else{echo "Nie ma połączenia z bazą danych";}

?>


</form>
</body>
</html>
