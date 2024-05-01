<?php
session_start();
if (isset($_POST["submit"])) {
  $id = $_POST["id"];
  $detail = $_POST["detail"];
  $userId = $_SESSION["userid"];
  $type = $_POST["type"];
  $files = [];
  $uploadedFiles = [];
  if (isset($_FILES["files"])) {
    // define ('SITE_ROOT', realpath(dirname(__FILE__)));
    $target_dir = "..\uploads\\";
    $files = $_FILES;
    $numitems = count($files["files"]["name"]);	
    for ($i = 0; $i < $numitems; $i++) {
      if ($files["files"]["error"][$i] == 0) {
        $fileDestination = $target_dir . time() . $files["files"]["name"][$i];
        move_uploaded_file($files["files"]["tmp_name"][$i], $fileDestination);
        $uploadedFiles[] = [
          ("name") => $files["files"]["name"][$i],
          ("path") => $fileDestination];
      } else {
        echo "Error uploading file!";
      }
    }
  }
  // $files = $_FILES["files"];
  include "../models/dbh.classes.php";
  include "../models/tasks.models.php";
  include "../controllers/tasks.controller.php";

  $task = new TaskController();
  $task->submitATask($id, $detail, $uploadedFiles, $userId);

  header("location: /index.php?page=tasks&type=" . $type);
}