<?php

  class Database {

    private static $instancia = null;
    private $resultado; //Guarda el resultado de la query 
    private $con;       //Conexion con motor bbdd.

    //Para poder copiar objetos sin estar referenciados.
    private function __clone() {}

    //CONSTRUCTOR PRIVADO PARA QUE NO PUEDA INSTANCIARSE con NEW. SOlo con getDatabase para que si se instancia varias veces siga siendo el mismo objeto.
    //Creamos conexión con la BBDD.
    private function __construct() {
      try {
        $this->con = new mysqli("web-database.c3px6ejwrsfd.us-east-1.rds.amazonaws.com", "admin", "marbella2022", "agenda");
        
      } catch (\Throwable $th) {
        die("Error de conexión con el motor de Bases de Datos.");
      }
    }

    public function query(String $sql){
      $this->resultado = $this->con->query($sql);
      return $this;
    }

    public function getData($class = "StdClass") {
      return $this->resultado->fetch_object($class);
    }
    
    public function getAll($class = "StdClass") {
      $salida = [];

      while($item = $this->getData($class))
        $salida[] = $item ;
      //
      return $salida;
    }

    //PATRON SINGLETON - Siempre misma instancia de DB.
    public static function getDatabase() {
      if (self::$instancia == null) self::$instancia = new Database;
      return self::$instancia ;
    }

    //Para evitar inyección de codigo
    public function escape(array $cadenas): array {
      $salida = [];
      foreach($cadenas as $key => $item){
        $salida[$key] = $this->con->real_escape_string($item);  
      }
      return $salida;
    }

    public function escapeString($string): String {
      return $this->con->real_escape_string($string);
    }
  }