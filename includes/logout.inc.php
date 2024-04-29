<?php
if(isset($_POST["submit"])){
  include "../models/dbh.classes.php";
  include "../models/login.models.php";
  include "../controllers/logout.controller.php";

  $logout = new LogoutController();
  $logout->logoutAUser();
  header("location: /index.php?page=login");
  exit();
}