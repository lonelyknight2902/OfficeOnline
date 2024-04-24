<?php
if(isset($_POST["submit"])) {
  $uid = $_POST["uid"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];
  $email = $_POST["email"];

  include "../classes/signup-contr.classes.php";
  include "../classes/signup.classes.php";
  include "../classes/dbh.classes.php";
  $signup = new SignupContr($uid, $password, $passwordRepeat, $email);
  $signup->signUpUser();

  header("location: ../signup.php?error=none");
}