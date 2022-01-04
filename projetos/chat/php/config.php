<?php
  $hostname = "localhost";
  $username = "id17457512_id17304333_delimajeferson";
  $password = "@&bGB>7N2|1)%|2i";
  $dbname = "id17457512_pedidos";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
