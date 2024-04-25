<?php

class SignupController extends Signup
{
  private $uid;
  private $password;
  private $passwordRepeat;
  private $email;

  public function __construct($uid, $password, $passwordRepeat, $email)
  {
    $this->uid = $uid;
    $this->password = $password;
    $this->passwordRepeat = $passwordRepeat;
    $this->email = $email;
  }

  public function signUpUser()
  {
    if ($this->emptyInput()) {
      header("location: ../signup.php?error=emptyinput");
      exit();
    }
    if ($this->invalidUid()) {
      header("location: ../signup.php?error=username");
      exit();
    }
    if ($this->invalidEmail()) {
      header("location: ../signup.php?error=email");
      exit();
    }
    if ($this->invalidPassword()) {
      header("location: ../signup.php?error=password");
      exit();
    }
    if ($this->uidTakenCheck()) {
      header("location: ../signup.php?error=usernametaken");
      exit();
    }
    $this->setUser($this->uid, $this->email, $this->password);
    
  }

  private function emptyInput()
  {
    if (empty($this->uid) || empty($this->password) || empty($this->passwordRepeat) || empty($this->email)) {
      return true;
    } else {
      return false;
    }
  }

  private function invalidUid()
  {
    if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
      return false;
    } else {
      return true;
    }
  }

  private function invalidEmail()
  {
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return false;
    } else {
      return true;
    }
  }

  private function invalidPassword()
  {
    if ($this->password !== $this->passwordRepeat) {
      return false;
    } else {
      return true;
    }
  }

  private function uidTakenCheck()
  {
    $signup = new Signup();
    if (!$signup->checkUser($this->uid, $this->email)) {
      return false;
    } else {
      return true;
    }
  }
}