<?php
if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];
  $email = $_POST["email"];
  $title = $_POST["title"];
  include "../models/dbh.classes.php";
  include "../models/signup.models.php";
  include "../controllers/signup.controller.php";
  $signup = new SignupController($name, $username, $password, $passwordRepeat, $email, $title);
  $signup->signUpUser();

  header("location: /index.php?page=users&error=none");
} else {
  header("location: /index.php?page=users");
}