<?php

class Login extends Dbh
{
  protected function loginUser($username,$password)
  {
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $this->connect()->prepare($sql);
    if (!$stmt->execute([$username])) {
      $stmt = null;
      header("location: /index.php?page=login&error=stmtfailed");
      exit();
    }

    if($stmt->rowCount() == 0){
      $stmt = null;
      header("location: /index.php?page=login&error=usernotfound");
      exit();
    }

    $hashedPassword = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $checkPassword = password_verify($password, $hashedPassword[0]["password"]);
    if(!$checkPassword) {
      $stmt = null;
      header("location: /index.php?page=login&error=wrongpassword");
      exit();
    }
    else {
      $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ? OR email = ?AND password = ?");
      if (!$stmt->execute([$username, $username,$password])) {
        $stmt = null;
        header("location: /index.php?page=login&error=stmtfailed");
        exit();
      }
      if($stmt->rowCount() == 0){
        $stmt = null;
        header("location: /index.php?page=login&error=usernotfound");
        exit();
      }

      $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
      session_start();
      $_SESSION["userid"] = $user[0]["id"];
      $_SESSION["username"] = $user[0]["username"];
      $_SESSION["email"] = $user[0]["email"];
      $_SESSION["role"] = $user[0]["role"];
      $_SESSION["department"] = $user[0]["department"];
      $cookie_name = "user";
      $cookie_value = $user[0];
      setcookie($cookie_name, serialize($cookie_value), time() + (86400 * 30), "/");
      $stmt = null;
    }
  }
}