<?php

class SignupController extends Signup
{
  private $name;
  private $username;
  private $password;
  private $passwordRepeat;
  private $email;
  private $title;
  private $role;
  private $department;

  public function __construct($name, $username, $password, $passwordRepeat, $email, $title, $role, $department)
  {
    $this->name = $name;
    $this->username = $username;
    $this->password = $password;
    $this->passwordRepeat = $passwordRepeat;
    $this->email = $email;
    $this->title = $title;
    $this->role = $role;
    $this->department = $department;
  }

  public function signUpUser()
  {
    if ($this->emptyInput()) {
      header("location: /index.php?page=create-user&error=emptyinput");
      exit();
    }
    if ($this->invalidUsername()) {
      header("location: /index.php?page=create-user&error=username&username=$this->username");
      exit();
    }
    if ($this->invalidEmail()) {
      header("location: /index.php?page=create-user&error=email");
      exit();
    }
    if ($this->invalidPassword()) {
      header("location: /index.php?page=create-user&error=password");
      exit();
    }
    if ($this->usernameTakenCheck()) {
      header("location: /index.php?page=create-user&error=usernametaken");
      exit();
    }
    $this->setUser($this->name, $this->username, $this->password, $this->email, $this->title, $this->role, $this->department);
    
  }

  private function emptyInput()
  {
    if (empty($this->name) || empty($this->username) || empty($this->password) || empty($this->passwordRepeat) || empty($this->email) || empty($this->title)) {
      return true;
    } else {
      return false;
    }
  }

  private function invalidUsername()
  {
    if (preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
      return false;
    } else {
      return true;
    }
  }

  private function invalidEmail()
  {
    if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return false;
    } else {
      return true;
    }
  }

  private function invalidPassword()
  {
    if ($this->password !== $this->passwordRepeat) {
      return true;
    } else {
      return false;
    }
  }

  private function usernameTakenCheck()
  {
    $signup = new Signup();
    if ($signup->checkUser($this->username, $this->email)) {
      return false;
    } else {
      return true;
    }
  }
}