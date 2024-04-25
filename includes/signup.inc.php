<?php
if(isset($_POST["submit"])) {
  $uid = $_POST["uid"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];
  $email = $_POST["email"];

  include "../controllers/signup.controller.php";
  include "../models/signup.models.php";
  include "../models/dbh.classes.php";
  $signup = new SignupController($uid, $password, $passwordRepeat, $email);
  $signup->signUpUser();

  header("location: ../signup.php?error=none");
}