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
    $sql = "SELECT t.id, t.name, t.description, t.deadline, t.status, t.priority, t.type, t.department, u.id userId, u.name userName  FROM tasks t LEFT JOIN tasks_users tu ON t.id = tu.Tasks_id LEFT JOIN users u ON tu.Users_id = u.id WHERE t.department = ? ORDER BY t.id, u.id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$department]);
    $results = $stmt->fetchAll();
    $tasks = [];
    $currentTaskId = null;
    foreach ($results as $result) {
      $taskId = $result['id'];
      if ($taskId !== $currentTaskId) {
        $tasks[$taskId] = [
          'id' => $result['id'],
          'name' => $result['name'],
          'description' => $result['description'],
          'deadline' => $result['deadline'],
          'status' => $result['status'],
          'priority' => $result['priority'],
          'type' => $result['type'],
          'department' => $result['department'],
          'users' => []
        ];
        $currentTaskId = $taskId;
      }
      if($result['userId'] !== null){
        $tasks[$currentTaskId]['users'][] = [
          'id' => $result['userId'],
          'name' => $result['userName']
        ];
      }
    }
    return $tasks;
  }

  protected function getTask($id)
  {
    $sql = "SELECT t.id, t.name, t.description, t.deadline, t.status, t.priority, t.type, t.department, u.id userId, u.name userName  FROM tasks t LEFT JOIN tasks_users tu ON t.id = tu.Tasks_id LEFT JOIN users u ON tu.Users_id = u.id WHERE t.id = ? ORDER BY t.id, u.id";
    // $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $results = $stmt->fetchAll();
    if (!$results) {
      header("location: /index.php?page=tasks");
      exit();
    }
    $task = [];
    $currentTaskId = null;
    foreach ($results as $taskInfo) {
      $taskId = $taskInfo['id'];
      if ($taskId !== $currentTaskId) {
        $task = [
          'id' => $taskInfo['id'],
          'name' => $taskInfo['name'],
          'description' => $taskInfo['description'],
          'deadline' => $taskInfo['deadline'],
          'status' => $taskInfo['status'],
          'priority' => $taskInfo['priority'],
          'type' => $taskInfo['type'],
          'department' => $taskInfo['department'],
          'users' => []
        ];
        $currentTaskId = $taskId;
      }
      if($taskInfo['userId'] !== null){
        $task['users'][] = [
          'id' => $taskInfo['userId'],
          'name' => $taskInfo['userName']
        ];
      }
    }
    $task['submissions'] = $this->getSubmissions($id);

    return $task;
  }

  protected function getSubmissions($id)
  {
    $sql = "SELECT s.id, s.detail, s.createdAt, u.id userId, u.name userName FROM submissions s JOIN users u ON s.createdBy = u.id WHERE taskId = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $submissions = $stmt->fetchAll();
    return $submissions;
  }

  protected function submitTask($id, $detail, $files, $userId)
  {
    $sql = "INSERT INTO submissions (taskId, detail, createdBy) VALUES (?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $detail, $userId]);
    $this->editTaskStatus($id, "Reviewing");
    // if(!$files){
    //   return;
    // }
    // if(count($files) === 0){
    //   return;
    // }
    // $detailId = $this->connect()->lastInsertId();
    // foreach ($files as $file) {
    //   $sql = "INSERT INTO task_files (Task_details_id, file) VALUES (?, ?)";
    //   $stmt = $this->connect()->prepare($sql);
    //   $stmt->execute([$detailId, $file]);
    // }
  }

  protected function editTaskStatus($id, $status)
  {
    $sql = "UPDATE tasks SET status = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $id]);
  }

  protected function getNumberOfTasksOfDepartment($department)
  {
    $sql = "SELECT status, COUNT(*) number FROM tasks WHERE type = 'department' AND department = ? GROUP BY status ORDER BY FIELD(status,'Todo','In Progress','Reviewing', 'Done', 'Rejected');";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$department]);
    $result = $stmt->fetchAll();
    return $result;
  }

  protected function getNumberOfTasksOfCompany()
  {
    $sql = "SELECT status, COUNT(*) number FROM tasks WHERE type = 'company' GROUP BY status ORDER BY FIELD(status,'Todo','In Progress','Reviewing', 'Done', 'Rejected');";
    $stmt = $this->connect()->query($sql);
    $result = $stmt->fetchAll();
    return $result;
  }

  public function getNumberOfTasksOfUser($userId)
  {
    $sql = "SELECT t.status, COUNT(*) number FROM tasks t JOIN tasks_users tu ON t.id = tu.Tasks_id JOIN users u ON u.id = tu.Users_id WHERE u.id = ? GROUP BY status ORDER BY FIELD(status,'Todo','In Progress','Reviewing', 'Done', 'Rejected');";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$userId]);
    $result = $stmt->fetchAll();
    return $result;
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