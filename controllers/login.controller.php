<?php

class LoginController extends Login
{
  private $uid;
  private $password;
  private $passwordRepeat;
  private $email;

  public function __construct($uid, $password)
  {
    $this->uid = $uid;
    $this->password = $password;
  }

  public function loginUser()
  {
    if ($this->emptyInput()) {
      header("location: ../signup.php?error=emptyinput");
      exit();
    }
    $this->getUser($this->uid, $this->password);
    
  }

  private function emptyInput()
  {
    if (empty($this->uid) || empty($this->password)) {
      return true;
    } else {
      return false;
    }
  }
}