<?php

  class Libro {
    private $isbn;
    private $titulo;
    private $autor;

    public function __construct(){}

    public function __get($key){
      return $this->$key;
    }

    public function __set($key, $value){
      $this->$key = $value;
    }

    public function __toString(){
      return $this->titulo;
    }

    public static function getLibroByISBN($isbn){
      return Database::getDataBase()->query("SELECT * FROM libro WHERE isbn='{$isbn}';")->getData("Libro");
    }

    public static function getAllLibros(){
      return Database::getDataBase()->query("SELECT * FROM libro;")->getAll("Libro");
    }

    public function getLastPrestamo(){
      $sql = "SELECT * FROM prestamo WHERE isbn='{$this->isbn}' AND devolucion IS NULL;";
      return Database::getDataBase()->query($sql)->getData();
    }

    public function devolver(){
      $sql = "UPDATE prestamo SET devolucion = CURDATE() WHERE isbn='{$this->isbn}' AND devolucion IS NULL;";
      Database::getDataBase()->query($sql);
    }
  }