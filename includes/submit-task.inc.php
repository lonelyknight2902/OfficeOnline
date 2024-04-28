<?php
session_start();
if(isset($_POST["submit"])){
  $id = $_POST["id"];
  $detail = $_POST["detail"];
  $userId = $_SESSION["userid"];
  // $files = $_FILES["files"];
  $files = [];
  include "../models/dbh.classes.php";
  include "../models/tasks.models.php";
  include "../controllers/tasks.controller.php";

  $task = new TaskController();
  $task->submitATask($id, $detail, $files, $userId);

  header("location: /index.php?page=tasks");
}