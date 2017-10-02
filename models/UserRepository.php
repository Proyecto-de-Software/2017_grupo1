<?php
class UserRepository extends PDORepository
{
  public function getAll()
  {
    $data = $this->queryList("select * from users", []);
    $answer = [];
    foreach ($data as &$element) {
      $answer[] = new User(
        $element['id'],
        $element['name'],
        $element['password'],
        $element['active'],
        $element['updated_at'],
        $element['created_at'],
        $element['first_name'],
        $element['last_name']
      );
    }

    return $answer;
  }
}
