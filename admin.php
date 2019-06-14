<?php
session_start();
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
    <title>Strona admina</title>
  </head>
  <body>
    <h2>Cześć,admin!</h2>
    <br> <a href="./logout.php">Wyloguj się!</a>

    <h3>Baza użytkowników:</h3>
    <table>

      <th>id</th>
      <th>login</th>
      <th>email</th>
      <th>dni nauki</th>
<form class="" action="admin.php" method="post">
      <?php
      require_once "./connect.php";
      if($polaczenie=mysqli_connect($host,$db_user,$db_password,$db_name))
      {  mysqli_set_charset($polaczenie, 'utf8');
         $sql = "SELECT * FROM `users`";
         $rezultat = mysqli_query($polaczenie, $sql);
         while ($wiersz = mysqli_fetch_assoc($rezultat)) {
           echo  <<<WIERSZ
         <tr>
         <td>$wiersz[id]</td>
         <td>$wiersz[login]</td>
         <td>$wiersz[email]</td>
         <td>$wiersz[liczba_dni]</td>
         </tr>
         <br>
WIERSZ;

      }
      if((isset($_POST['number']))&&(isset($_POST['submit'])))
      { $nr=$_POST['number'];
        $sql2 = "DELETE from users where id='$nr'";
        if(mysqli_query($polaczenie,$sql2))
        {
          $_SESSION['usun']= "<br>Dane użytkownika z ID nr $nr zostały usunięte z bazy ";
        }
        else{echo "Błąd zapytania";}
      }



    }  else{echo "Nie ma połączenia";}
       ?>
</form>
    </table>

    <form class="" action="admin.php" method="post">


          <select name="number" >
      <?php
      $rezultat = mysqli_query($polaczenie, $sql);
      while ($wiersz = mysqli_fetch_assoc($rezultat)) {
        echo  <<<WIERSZ
      <option value ="$wiersz[id]">$wiersz[id]</option>

WIERSZ;

   }
    if(isset($_SESSION['usun']))
    {
      echo $_SESSION['usun'];
      unset($_SESSION['usun']);
    }
     $rezultat = mysqli_query($polaczenie, $sql);
         ?>
         <input type="submit" name="submit" value="usuń">
    </form>
  </body>
</html>
