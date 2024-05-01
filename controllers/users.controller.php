<?php

class UserController extends Users
{
  function getAllUsers()
  {
    return $this->getUsers();
  }

  function getAllUsersFromDepartment($department) {
    if($department == 0) {
      return $this->getHeads();
    } else {
      return $this->getUserFromDepartment($department);
    }
  }
}