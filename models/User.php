<?php
class User
{
  public $id;
  public $name;
  public $password;
  public $active;
  public $updated_at;
  public $created_at;
  public $first_name;
  public $last_name;

  public function __construct($id, $name, $password, $active, $updated_at, $created_at, $first_name, $last_name)
  {
    $this->$id = $id;
    $this->$name = $name;
    $this->$password = $password;
    $this->$active = $active;
    $this->$updated_at = $updated_at;
    $this->$created_at = $created_at;
    $this->$first_name = $first_name;
    $this->$last_name = $last_name;
  }
}