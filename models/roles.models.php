<?php

class Roles extends Dbh
{
  protected function getRoles()
  {
    $sql = "SELECT r.*, p.id permissionId, p.name permissionName FROM roles r LEFT JOIN roles_permissions rp ON r.id = rp.roleId LEFT JOIN permissions p ON rp.permissionId = p.id";
    $stmt = $this->connect()->query($sql);
    $results = $stmt->fetchAll();
    $role = [];
    $currentIndex = -1;
    $currentRoleId = null;
    foreach ($results as $result) {
      $roleId = $result['id'];
      if ($roleId !== $currentRoleId) {
        $currentIndex++;
        $role[$currentIndex] = [
          'id' => $result['id'],
          'name' => $result['name'],
          'permissions' => []
        ];
        $currentRoleId = $roleId;
      }
      if($result['permissionId'] !== null){
        $role[$currentIndex]['permissions'][] = [
          'id' => $result['permissionId'],
          'name' => $result['permissionName']
        ];
      }
    }
    return $role;
  }

  protected function getPermissions()
  {
    $sql = "SELECT * FROM permissions";
    $stmt = $this->connect()->query($sql);
    $results = $stmt->fetchAll();
    return $results;
  }

  protected function updatePermissions($roleId, $permissions)
  {
    $sql = "DELETE FROM roles_permissions WHERE roleId = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$roleId]);
    foreach ($permissions as $permission) {
      $sql = "INSERT INTO roles_permissions (roleId, permissionId) VALUES (?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$roleId, $permission]);
    }
  }
}