<?php

  class Lector {
    private $dni;
    private $nombre;
    private $apellido;

    public function __construct(){}

    public function __get($key){
      return $this->$key;
    }

    public function __set($key, $value){
      $this->$key = $value;
    }

    public function __toString(){
      return $this->nombre." ".$this->apellidos;
    }

    public static function check($dni){
      return !!Database::getDataBase()->query("SELECT * FROM lector WHERE dni='{$dni}';")->getData();
    }

    public static function getAll(){
      return Database::getDataBase()->query("SELECT * FROM lector;")->getAll("Lector");
    }
  }