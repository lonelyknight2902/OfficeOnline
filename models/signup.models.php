<?php
class Signup extends Dbh
{
  protected function setUser($uid, $email, $password)
  {
    $sql = "INSERT INTO users (users_uid, users_email, users_password) VALUES (?, ?, ?)";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->connect()->prepare($sql);
    if (!$stmt->execute([$uid, $email, $hashedPassword])) {
      $stmt = null;
      header("location: ../signup.php?error=stmtfailed");
      exit();
    }

    $stmt = null;
    // header("location: ../signup.php?error=none");
  }
  protected function checkUser($uid, $email)
  {
    $sql = "SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?";
    $stmt = $this->connect()->prepare($sql);
    if (!$stmt->execute([$uid, $email])) {
      $stmt = null;
      header("location: ../signup.php?error=stmtfailed");
      exit();
    }

    if ($stmt->rowCount() > 0) {
      return false;
    }
    return true;
  }
}