<?php
  class Lista {
    private $id;
    private $idUsu;
    private $description;
    private $state;

    public function __construct()
    {
    }

    public function __get($key){
      return $this->$key;
    }

    public function __set($key, $value){
      $this->$key = $value;
    }

    public function changeState(){
      $newState = !$this->state ? 1 : 0;
      $sql = "UPDATE lista SET state ='{$newState}' WHERE id = $this->id AND idUsu = $this->idUsu";
      DataBase::getDataBase()->query($sql);
    } 

    public static function getAllByIdUser($idUsu){
      $sql = "SELECT * FROM lista WHERE idUsu='{$idUsu}';";
      return Database::getDataBase()->query($sql)->getAll("Lista");
    }

    public static function getTaskById($id){
      $sql = "SELECT * FROM lista WHERE id={$id};";
      return DataBase::getDataBase()->query($sql)->getData("Lista");
    }

    public function delete(){
      $sql = "DELETE FROM lista WHERE id=$this->id ";
      DataBase::getDataBase()->query($sql);
    }

    public function create(){
      $sql = "INSERT INTO lista VALUES (null, $this->idUsu,'{$this->description}','{$this->state}') ;";
      DataBase::getDataBase()->query($sql);
    }

    public function update(){
      $sql = "UPDATE lista SET description='{$this->description}' WHERE id = $this->id ";
      DataBase::getDataBase()->query($sql);
    }

  }
