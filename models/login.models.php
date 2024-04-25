<?php

class Login extends Dbh
{
  protected function getUser($username,$password)
  {
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $this->connect()->prepare($sql);
    if (!$stmt->execute([$username])) {
      $stmt = null;
      header("location: ../signup.php?error=stmtfailed");
      exit();
    }

    if($stmt->rowCount() == 0){
      $stmt = null;
      header("location: ../signup.php?error=usernotfound");
      exit();
    }

    $hashedPassword = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $checkPassword = password_verify($password, $hashedPassword[0]["password"]);
    if(!$checkPassword) {
      $stmt = null;
      header("location: ../signup.php?error=wrongpassword");
      exit();
    }
    else {
      $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ? OR email = ?AND password = ?");
      if (!$stmt->execute([$username, $username,$password])) {
        $stmt = null;
        header("location: ../signup.php?error=stmtfailed");
        exit();
      }
      if($stmt->rowCount() == 0){
        $stmt = null;
        header("location: ../signup.php?error=usernotfound");
        exit();
      }

      $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
      session_start();
      $_SESSION["userid"] = $user[0]["id"];
      $_SESSION["username"] = $user[0]["username"];
      $stmt = null;
    }
    // header("location: ../signup.php?error=none");
  }
}