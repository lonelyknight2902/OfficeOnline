<?php

class DepartmentController extends Departments
{
  public function getAllDepartments()
  {
    return $this->getDepartments();
  }
}