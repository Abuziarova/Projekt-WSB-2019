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
    <link rel="stylesheet" href="./admin.css">
  </head>
  <body>
    <div class=container>
    <h1>Witaj, Administratorze</h1>
    <h2>Baza użytkowników:</h2>
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
          // usuwamy dane wybranego użytkownika
            if((isset($_POST['number']))&&(isset($_POST['submit'])))
            { $nr=$_POST['number'];
            $sql2 = "DELETE from users where id='$nr'";
            if(mysqli_query($polaczenie,$sql2))
                {
                $_SESSION['usun']= "<br>Dane użytkownika z ID nr $nr zostały usunięte z bazy ";
                }
                else{echo "Błąd zapytania";}
            }
            if(isset($_SESSION['usun']))
                {
                echo $_SESSION['usun'];
                unset($_SESSION['usun']);
                }
                // wyświetlamy liste użytkowników
            $sql = "SELECT * FROM `users`";
            $rezultat = mysqli_query($polaczenie, $sql);
            while ($wiersz = mysqli_fetch_assoc($rezultat))
            {
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

        }
        else{echo "Nie ma połączenia";}
    ?>
    </form>
    </table>
    <form class="" action="admin.php" method="post">
    <select name="number" >
      <!-- tworzymy listę rozwijaną z numerami id -->
    <?php
    $rezultat = mysqli_query($polaczenie, $sql);
    while ($wiersz = mysqli_fetch_assoc($rezultat))
    {
    echo  <<<WIERSZ
    <option value ="$wiersz[id]">$wiersz[id]</option>
WIERSZ;
    }
    mysqli_close($polaczenie);
    ?>
    <input type="submit" name="submit" value="usuń">
    </form><br>
<form class="" action="admin.php" method="post">
  <fieldset>
  <legend><h2>Dodać pytanie to bazy:</h2></legend>
  Treść pytania:
  <input type="text" name="pytanie"><br>
  Odpowiedź a: <input type="text" name="odpa" value="" ><br>
  Odpowiedź b: <input type="text" name="odpb" value=""><br>
  Odpowiedź c: <input type="text" name="odpc" value=""><br>
  Odpowiedź d: <input type="text" name="odpd" value=""><br>
  Poprawna odpowiedź:
  <input type="radio" name="true" value="a" checked="checked">
  <input type="radio" name="true" value="b">
  <input type="radio" name="true" value="c">
  <input type="radio" name="true" value="d"><br>
  <input type="submit" name="pytanie" value="wyslij">
  <br>
<?php
if( (!empty($_POST['pytanie']))&&(!empty($_POST['odpa']))&&(!empty($_POST['odpb']))&&(!empty($_POST['odpc']))&&(!empty($_POST['odpd']))&&(!empty($_POST['true'])))
{  if($polaczenie2=mysqli_connect($host,$db_user,$db_password,$db_name))
   {mysqli_set_charset($polaczenie2, 'utf8');
    $pytanie=$_POST['pytanie'];
    $a=$_POST['odpa'];
    $b=$_POST['odpb'];
    $c=$_POST['odpc'];
    $d=$_POST['odpd'];
    $ans=$_POST['true'];
    $sql3 = "INSERT INTO `pytania` (`id`, `tresc`, `odpa`, `odpb`, `odpc`, `odpd`, `answer`) VALUES (NULL,'$pytanie', '$a', '$b', '$c', '$d','$ans' )";
    if(mysqli_query($polaczenie2,$sql3))
    {
      $_SESSION['dodane']="Pytanie dodane do bazy!";

    }else{ echo "Niepoprawne zapytanie";}
    mysqli_close($polaczenie2);
   }else {echo "Nie ma połączenia z bazą";}

}
if(isset($_SESSION['dodane']))
    {
    echo $_SESSION['dodane'];
    unset($_SESSION['dodane']);
    }
 ?>
  </fieldset>
</form>
<br>
    <center><a href="./logout.php">Wyloguj się</a></center>
    </div>
  </body>
</html>
