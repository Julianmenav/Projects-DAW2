<?php 

  /**
   * Autor: Julián Mena Viñas 12/12/22 
   * 
   */
  
  class Tarea {
    private $idTar ;
    private $titulo ;
    private $texto ;
    private $inicio ;
    private $fin ;

    public function __get($key){
      return $this->$key;
    }
    
    public function isCompleted(){
      if(is_null($this->fin)) return false;
      return true;
    }

    public function getTags(){
      $sql = "SELECT etiqueta.idEtq, etiqueta.nombre, etiqueta.color FROM tiene, etiqueta WHERE idTar=$this->idTar AND tiene.idEtq = etiqueta.idEtq ; ";
      return Database::getDatabase()->query($sql)->getAll("Etiqueta");
    }

    public static function getTaskById($id){
      $sql = "SELECT * FROM tarea WHERE idTar = '$id';";
      return Database::getDataBase()->query($sql)->getData("Tarea");
    }

    public function changeState(){
      //Si es null le metemos alguna fecha.
      if(is_null($this->fin)){
        $sql = "UPDATE tarea SET fin = CURDATE() WHERE idTar = $this->idTar;";
        Database::getDataBase()->query($sql);
      }
      //Si no, la eliminamos.
      else{
        $sql = "UPDATE tarea SET fin = null WHERE idTar = $this->idTar;";
        Database::getDataBase()->query($sql);
      }
    } 

    public function delete(){
      $sql = "DELETE FROM tarea WHERE idTar = $this->idTar;";
      $sql2 = "DELETE FROM tiene WHERE idTar = $this->idTar;";
      Database::getDataBase()->query($sql)->query($sql2);
    }
  }