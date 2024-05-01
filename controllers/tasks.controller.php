<?php

class TaskController extends Tasks
{
  public function getAllTasks()
  {
    return $this->getTasks();
  }

  // public function getTask($id)
  // {
  //   return $this->getTaskById($id);
  // }

  public function createTask($name, $deadline, $priority, $description, $assignee, $created_by, $type, $department)
  {
    $this->setTask($name, $deadline, $priority, $description, $assignee, $created_by, $type, $department);
  }

  public function getAllTasksByDepartment($department)
  {
    if($department == 0) {
      return $this->getTasksByCompany();
    } else {
      return $this->getTasksByDepartment($department);
    }
  }

  public function getATask($id)
  {
    return $this->getTask($id);
  }

  public function submitATask($id, $detail, $files, $userId) {
    $this->submitTask($id, $detail, $files, $userId);
  }

  // public function updateTask($id, $title, $description, $due_date, $status, $priority, $user_id)
  // {
  //   $this->editTask($id, $title, $description, $due_date, $status, $priority, $user_id);
  // }

  public function getNumberOfTasks($department)
  {
    if($department == 0) {
      return $this->getNumberOfTasksOfCompany();
    } else {
      return $this->getNumberOfTasksOfDepartment($department);
    }
  }

  public function submitAComment($id, $content, $userId)
  {
    $this->submitComment($id, $content, $userId);
  }

  public function getNumberOfTasksOfAUser($userId)
  {
    return $this->getNumberOfTasksOfUser($userId);
  }

  public function updateATaskStatus($id, $status)
  {
    $this->editTaskStatus($id, $status);
  }

  // public function deleteTask($id)
  // {
  //   $this->removeTask($id);
  // }
}