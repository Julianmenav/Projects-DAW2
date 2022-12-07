<?php
  class Usuario {

    private $idUsu;
    private $email;
    private $password;
    private $name;

    public function __get($key){
      return $this->$key;
    }

    public function __sleep(){
      return ["idUsu", "email", "password", "name"];
    }

    public function __wakeup(){

    }

    public function __toString(){
      return $this->name;
    }

  }