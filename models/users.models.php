<?php

class Users extends Dbh
{
  protected function getUsers()
  {
    $sql = "SELECT users.id, users.name, users.username, users.email, users.title, roles.name AS roleName, departments.name AS departmentName FROM users JOIN roles ON users.role = roles.id JOIN departments ON users.department = departments.id";
    $stmt = $this->connect()->query($sql);
    $users = $stmt->fetchAll();
    return $users;
  }

  protected function setUser($name, $username, $password, $email, $title)
  {
    $sql = "INSERT INTO users (name, username, password, email, title) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$name, $username, $password, $email, $title]);
  }

  protected function getUser($username)
  {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    return $user;
  }

  protected function deleteUser($username)
  {
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]);
  }

  protected function getHeads()
  {
    $sql = "SELECT id FROM roles WHERE name = 'Head'";
    $stmt = $this->connect()->query($sql);
    $head = $stmt->fetch();
    $sql = "SELECT * FROM users WHERE role = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$head['id']]);
    $head = $stmt->fetchAll();
    return $head;
  }

  protected function getUserFromDepartment($department)
  {
    $sql = "SELECT * FROM users WHERE department = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$department]);
    $users = $stmt->fetchAll();
    return $users;
  }
}