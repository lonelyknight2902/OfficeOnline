<?php

class Roles extends Dbh
{
  protected function getRoles()
  {
    $sql = "SELECT * FROM roles";
    $stmt = $this->connect()->query($sql);
    $results = $stmt->fetchAll();
    return $results;
  }
}