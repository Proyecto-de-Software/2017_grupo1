<?php
class UserRepository extends PDORepository
{
  private function queryToUserArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new User(
        $element['id'],
        $element['username'],
        $element['password'],
        $element['active'],
        $element['updated_at'],
        $element['creadted_at'],
        $element['first_name'],
        $element['last_name']
      );

    return $data;
  	}
  }

  public function getAll()
  {
    return $this->queryToUserArray($this->queryList("select * from users", []));
  }

  public function getAllActive($isActive)
  {
    return $this->queryToUserArray($this->queryList("select * from users where active = ?", [$isActive]));
  }

  public function getAllByName($name)
  {
    return $this->queryToUserArray($this->queryList("select * from users where name LIKE ?", [$$name]));
  }
}
