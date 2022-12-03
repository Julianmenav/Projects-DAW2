<?php

  class Token {

    private string $token;

    public function __construct() {
      $this->token = md5(time());
      
      $_SESSION["_token"] = $this->token;
    }
    
    public function __toString() {
      return $this->token;
    }

    public static function check(string $token): bool {
      return ($_SESSION["_token"]==$token);
    }
  }