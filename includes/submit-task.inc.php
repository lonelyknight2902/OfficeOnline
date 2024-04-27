<?php
if(isset($_POST["submit"])){
  $id = $_POST["id"];
  $detail = $_POST["detail"];
  $files = $_FILES["files"];
  include "../models/dbh.classes.php";
  include "../models/tasks.models.php";
  include "../controllers/tasks.controller.php";

  $task = new TaskController();
  $task->submitATask($id, $detail, $files);

  header("location: /index.php?page=tasks");
}