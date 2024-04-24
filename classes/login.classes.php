<?php

class Login extends Dbh
{
  protected function getUser($uid,$password)
  {
    $sql = "SELECT users_pwd FROM users WHERE users_uid = ?";
    $stmt = $this->connect()->prepare($sql);
    if (!$stmt->execute([$uid])) {
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
    $checkPassword = password_verify($password, $hashedPassword[0]["users_pwd"]);
    if(!$checkPassword) {
      $stmt = null;
      header("location: ../signup.php?error=wrongpassword");
      exit();
    }
    else {
      $stmt = $this->connect()->prepare("SELECT * FROM users WHERE users_uid = ? OR users_email = ?AND users_pwd = ?");
      if (!$stmt->execute([$uid, $uid,$password])) {
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
      $_SESSION["userid"] = $user[0]["users_id"];
      $_SESSION["useruid"] = $user[0]["users_uid"];
      $stmt = null;
    }
    // header("location: ../signup.php?error=none");
  }
}