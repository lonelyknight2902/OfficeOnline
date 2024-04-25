<?php

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $deadline = $_POST['deadline'];
  $priority = $_POST['priority'];
  $description = $_POST['description'];
  $assignee = $_POST['assignee'];
  $created_by = $_GET['created_by'];
  $type = $_GET['type'];
  $department = $_GET['department'];

  require_once '../models/dbh.classes.php';
  require_once '../models/tasks.models.php';
  require_once '../controllers/tasks.controller.php';

  $taskController = new TaskController();
  $taskController->createTask($name, $deadline, $priority, $description, $assignee, $created_by, $type, $department);
  header('Location: /index.php?page=tasks');
} else {
  header('Location: /index.php?page=tasks');
}