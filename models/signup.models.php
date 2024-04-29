<?php
class Signup extends Dbh
{
  protected function setUser($name, $username, $password, $email, $title, $role, $department)
  {
    $sql = "INSERT INTO users (name, username, password, email, title, role, department) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->connect()->prepare($sql);
    if (!$stmt->execute([$name, $username, $hashedPassword, $email, $title, $role, $department])) {
      $stmt = null;
      header("location: /index.php?page=task&error=stmtfailed");
      exit();
    }

    $stmt = null;
    // header("location: ../signup.php?error=none");
  }
  protected function checkUser($username, $email)
  {
    $sql = "SELECT username FROM users WHERE username = ? OR email = ?";
    $stmt = $this->connect()->prepare($sql);
    if (!$stmt->execute([$username, $email])) {
      $stmt = null;
      header("location: /index.php?page=task&error=stmtfailed");
      exit();
    }

    if ($stmt->rowCount() > 0) {
      return false;
    }
    return true;
  }
}