<?php
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  include "../models/dbh.classes.php";
  include "../models/login.models.php";
  include "../controllers/login.controller.php";

  $login = new LoginController($username, $password);
  $login->loginAUser();

  header("location: /index.php?page=overview");
}