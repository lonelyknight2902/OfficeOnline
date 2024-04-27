<?php

class LoginController extends Login
{
  private $username;
  private $password;

  public function __construct($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
  }

  public function loginAUser()
  {
    if ($this->emptyInput()) {
      header("location: /index.php?page=login&error=emptyinput");
      exit();
    }
    $this->loginUser($this->username, $this->password);
    
  }

  private function emptyInput()
  {
    if (empty($this->username) || empty($this->password)) {
      return true;
    } else {
      return false;
    }
  }
}