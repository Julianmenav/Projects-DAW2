
<?php
  class Database {
    private static $instancia = null;
    private $resultado;
    private $con;

    private function __construct() {
      try{  
        $this->con = new mysqli("web-database.ceguh84colq0.us-east-1.rds.amazonaws.com", "admin", "", "todolist");
      } catch(mysqli_sql_exception $e){
        die("Error con la base de datos");
      }
    }
    //SINGLETON
    public static function getDataBase() {
      if (self::$instancia == null) self::$instancia = new Database ;
      return self::$instancia;
    }
    public function escape(array $arr): array {
      $result = [];
      foreach($arr as $key => $value){
        $result[$key] = $this->con->real_escape_string($value);
      }  
      return $result;
    }

    public function query($sql){
      $this->resultado = $this->con->query($sql);
      return $this;
    }

    public function getData($class = "StdClass"){
      return $this->resultado->fetch_object($class);
    }

    public function getAll($class = "StdClass"){
      $result = [];

      while($item = $this->getData($class)){
        $result[] = $item;
      }

      return $result;
    }
  }