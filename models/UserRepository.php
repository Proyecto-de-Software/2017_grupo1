<?php
class UserRepository extends PDORepository
{
  private $stmtToggleActive;

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
        $element['created_at'],
        $element['first_name'],
        $element['last_name']
      );

    }
    return $answer;
  }

  public function __construct()
  {
    $this->stmtToggleActive = $this->newPreparedStmt("update usets set active = not active where id = ?");
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
    return $this->queryToUserArray($this->queryList("select * from users where name LIKE ?", [$ $name]));
  }

  public function toggleActive($userId)
  {
    $this->stmtToggleActive->execute([$userIdid]);
  }
}
