<?php
if(isset($_POST['submit'])){
  include "../models/dbh.classes.php";
  include "../models/roles.models.php";
  include "../controllers/roles.controller.php";
  $roleController = new RoleController();
  $roleId = $_POST['id'];
  $permissions = $roleController->getAllPermissions();
  $data = [];
  foreach ($permissions as $permission) {
    if(isset($_POST[$permission['id']])){
      echo $permission['name'];
      $data[] = $permission['id'];
    }
  }
  $roleController->updateRolePermissions($roleId, $data);
  header("location: /index.php?page=roles");
  exit();
}