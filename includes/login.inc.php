<?php
if(isset($_POST["submit"])) {
  $uid = $_POST["uid"];
  $password = $_POST["password"];

  include "../classes/login-contr.classes.php";
  include "../classes/login.classes.php";
  include "../classes/dbh.classes.php";
  $login = new LoginContr($uid, $password);
  $login->loginUser();

  header("location: ../login.php?error=none");
}