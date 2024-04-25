<?php

class Tasks extends Dbh
{
  protected function getTasks()
  {
    $sql = "SELECT * FROM tasks";
    $stmt = $this->connect()->query($sql);
    $results = $stmt->fetchAll();
    return $results;
  }

  protected function getTasksByDepartment($department)
  {
    $sql = "SELECT * FROM tasks WHERE department = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$department]);
    $results = $stmt->fetchAll();
    return $results;
  }

  protected function getTask($id)
  {
    $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $task = $stmt->fetch();
    if (!$task) {
      header("location: /index.php?page=tasks");
      exit();
    }
    return $task;
  }

  protected function setTask($name, $deadline, $priority, $description, $assignee, $created_by, $type, $department)
  {
    $sql = "INSERT INTO tasks (name, description, createdBy, deadline, status, priority, type, department) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $dbh = $this->connect();
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$name, $description, $created_by, $deadline, "Todo", $priority, $type, $department]);
    $id = $dbh->lastInsertId();
    $sql = "INSERT INTO tasks_users (Tasks_id, Users_id) VALUES (?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $assignee]);
  }
}