<?php
 require_once "./connect.php";

 $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

 if($polaczenie->connect_errno!=0)
 {
   echo "Error: ".$polaczenie->connect_errno;
 }
else {
 $login = $_POST['login'];
 $haslo = $_POST['haslo'];

  $sql = "select * from uzytkownicy where login = '$login' and haslo='$haslo'";

  if($rezultat=@$polaczenie->query($sql))
  {
    $ilu_userow=$rezultat->num_rows;
    if($ilu_userow>0)
    {
    $wiersz=$rezultat->fetch_assoc();
    $user=$wiersz['login'];

    $rezultat->free_result();
echo "zalogowałes się";
    echo $user;
    }
    else {
    echo "nie udało sie :(";
    }
  }


$polaczenie->close();
}

 ?>
