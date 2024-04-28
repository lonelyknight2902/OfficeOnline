<?php
if(isset($_POST['submit'])){
  $id = $_POST["id"];
  include "../models/dbh.classes.php";
  include "../models/tasks.models.php";
  include "../controllers/tasks.controller.php";

  $task = new TaskController();
  $task->updateATaskStatus($id, "Done");

  header("location: /index.php?page=task&id=$id");
}