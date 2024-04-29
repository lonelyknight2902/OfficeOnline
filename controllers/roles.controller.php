<?php

class RoleController extends Roles
{
  public function getAllRoles()
  {
    return $this->getRoles();
  }

  public function getAllPermissions()
  {
    return $this->getPermissions();
  }

  public function updateRolePermissions($roleId, $permissions)
  {
    $this->updatePermissions($roleId, $permissions);
  }
}