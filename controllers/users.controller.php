<?php

class UserController extends Users
{
  function getAllUsers()
  {
    return $this->getUsers();
  }
}