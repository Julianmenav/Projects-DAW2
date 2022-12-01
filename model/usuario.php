<?php

/**
 * Julian Mena
 * Clase Usuario
 */

class Usuario
{
  private int $id;
  private string $nombre;
  private string $apellido;
  private string $email;
  private string $password;

  //No me funciona por alguna razón
  public function getId(): int {
    return $this->id;
  }

  public function __construct()
  {
  }

  //Sleep y wakeUp para serializar y deserializar. Repasar.
  public function __sleep() {
    return ["id", "nombre", "apellido", "email"];
  }

  //Se invoca automáticamente cuando se hace una deserialización.
  public function __wakeup() {

  }

  public function __get($key) {
    return $this->$key;
  }


}
