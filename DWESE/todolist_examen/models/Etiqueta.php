<?php 

  /**
   * Autor: Julián Mena Viñas 12/12/22 
   * 
   */
  
  class Etiqueta {
    private $idEtq ;
    private $nombre ;
    private $color ;

    public function __get($key){
      if(property_exists("Etiqueta", $key)) return $this->$key;
      die("Error, la propiedad no existe");
    }

    public function __set($key, $value){
      $this->$key = $value;
    }
    
    public function isCompleted(){
      if(is_null($this->fin)) return false;
      return true;
    }

    public function __toString(){
      $div = "<a href='index.php?filter=".$this->nombre."' class='bg-[".$this->color."] text-white rounded-md px-3 py-1.5 text-center w-fit font-bold'>".$this->nombre."</a>";
      return $div;
    }

    public static function getAllTags(){
      return Database::getDataBase()->query("SELECT * FROM etiqueta")->getAll("Etiqueta");
    }

    public function create(){
      $sql = "INSERT INTO etiqueta VALUES (null, '{$this->nombre}', '{$this->color}');";
      Database::getDataBase()->query($sql);
    }
  }