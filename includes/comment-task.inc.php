<?php
if(isset($_POST['submit'])) {
  $comment = $_POST['comment'];
  $taskId = $_POST['taskId'];
  $userId = $_POST['userId'];

  require_once '../models/dbh.classes.php';
  require_once '../models/tasks.models.php';
  require_once '../controllers/tasks.controller.php';

  $taskController = new TaskController();
  $taskController->submitAComment($taskId, $comment, $userId);
  header('Location: /index.php?page=task&id=' . $taskId);
} else {
  header('Location: /index.php?page=tasks');
}