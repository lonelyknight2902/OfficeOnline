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
    return $this->getTasksByDepartment($department);
  }

  public function getATask($id)
  {
    return $this->getTask($id);
  }

  // public function updateTask($id, $title, $description, $due_date, $status, $priority, $user_id)
  // {
  //   $this->editTask($id, $title, $description, $due_date, $status, $priority, $user_id);
  // }

  // public function deleteTask($id)
  // {
  //   $this->removeTask($id);
  // }
}