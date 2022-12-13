<?php
  /**
   * Autor: Julián Mena Viñas 12/12/22 
   * 
   */
  
  class Csrf {
    private string $token;

    public function __construct() {
      $this->token = sha1(time());
      $_SESSION["_token"] = $this->token;
    }

    public function __toString() {
      return $this->token;
    }

    public static function check(string $token): bool {
      return ($_SESSION["_token"]==$token);
    }
  }
