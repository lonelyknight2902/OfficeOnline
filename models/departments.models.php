<?php

class Departments extends Dbh
{
  protected function getDepartments()
  {
    $sql = "SELECT * FROM departments";
    $stmt = $this->connect()->query($sql);
    $results = $stmt->fetchAll();
    return $results;
  }
}