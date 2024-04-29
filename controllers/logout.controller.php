<?php

class LogoutController extends Login
{
  public function logoutAUser()
  {
    $this->logoutUser();
  }
}