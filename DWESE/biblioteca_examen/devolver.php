<?php
  require_once("./models/Libro.php");
  require_once("./lib/Database.php");

  $isbn = $_GET["isbn"] ?? "";
  $libro = Libro::getLibroByISBN($isbn) ;
  if(is_null($libro)) exit(header("location: index.php"));

  $libro->devolver();
  exit(header("location: index.php?libros"));
  

  