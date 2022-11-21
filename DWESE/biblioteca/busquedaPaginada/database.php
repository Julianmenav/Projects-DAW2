<?php
  try {
    $con = new mysqli("localhost", "root", "", "biblioteca"); //172.31.12.107:3306 Es mi ip en el instituto
  } catch(mysqli_sql_exception $e ) {
    die("problemitas");
  }
?>