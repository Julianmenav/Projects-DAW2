<?php

/**
 * Julian Mena
 * Clase Contacto
 */
// echo dirname(__DIR__,) ; con estas variables (Buscar doc) podemos importar de manera relativa dando igual donde se ejecute este trozo de codigo.
// $_SERVER
require_once "./lib/database.php";

class Contacto
{
  private int $id;
  private int $idUsu;
  private string $nombre;
  private string $apellido;
  private string $email;
  private string $telefono;
  private string $foto;
  private string $observaciones;

  public function __construct()
  {
  }

  public function __get($key): string|int|null
  {
    return $this->$key;
  }

  public function __set($key, $valor)
  {
    $db = Database::getDatabase();
    $this->$key = $db->escapeString($valor);
  }

  public function save() {
    $db = Database::getDatabase();
    $sql =  "INSERT INTO contacto VALUES (null, $this->idUsu,'{$this->nombre}', '{$this->apellido}', '{$this->telefono}', '{$this->email}', '{$this->foto}', '{$this->observaciones}' );" ;
 
    $db->query($sql);
  }

  public function update() {
    $sql = "UPDATE contacto SET nombre='{$this->nombre}', apellido='{$this->apellido}', telefono='{$this->telefono}', email='{$this->email}', foto='{$this->foto}', observaciones='{$this->observaciones}' WHERE id={$this->id} AND idUsu={$this->idUsu};" ;
    Database::getDatabase()->query($sql);
  }

  public function delete() {
    $sql = "DELETE FROM contacto WHERE id = {$this->id}" ;

    Database::getDatabase()->query($sql);
  }

  public static function getById(int $idCon): Contacto {
    return Database::getDatabase()->query("SELECT * FROM contacto WHERE id = '{$idCon}'" )->getData("Contacto");
  }

  public static function getAllByUser(int $idUsu): array {
    $db = Database::getDatabase();
    
    $sql = "SELECT * FROM contacto WHERE idUsu = {$idUsu}";
    
    return $db->query($sql)->getAll("Contacto");
  }

  public function __toString() {
    return "{$this->nombre}   {$this->apellido}.  ";
  }

}

