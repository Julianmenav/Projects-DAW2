<?php

  class Prestamo {
    private $dni;
    private $isbn;
    private $prestamo;
    private $devolucion;

    public function __construct(){}

    public function __get($key){
      return $this->$key;
    }

    public function __set($key, $value){
      $this->$key = $value;
    }

    public static function getPrestamoById($id){
      return Database::getDataBase()->query("SELECT * FROM prestamo WHERE isbn='{$id}';")->getData("Prestamo");
    }
    
    public static function getAllByIdUser($id){
      return Database::getDataBase()->query("SELECT * FROM prestamo WHERE dni='{$id}';")->getAll("Prestamo");
    }
    
    public static function getAllByISBN($isbn){
      return Database::getDataBase()->query("SELECT * FROM prestamo WHERE isbn='{$isbn}';")->getAll("Prestamo");
    }
    
    public static function getAllPrestamos(){
      return Database::getDataBase()->query("SELECT * FROM prestamo;")->getAll("Prestamo");
    }
    
  }