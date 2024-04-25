<?php
if(isset($_POST["submit"])) {
  $uid = $_POST["uid"];
  $password = $_POST["password"];

  include "../controllers/login.controller.php";
  include "../models/login.models.php";
  include "../models/dbh.classes.php";
  $login = new LoginController($uid, $password);
  $login->loginUser();

  header("location: ../login.php?error=none");
}