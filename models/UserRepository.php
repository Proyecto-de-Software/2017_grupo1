<?php
class UserRepository extends PDORepository
{
  private $stmtToggleActive;
  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;

  private function queryToUserArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new User(
        $element['id'],
        $element['username'],
        $element['password'],
        $element['email'],
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
    $this->stmtToggleActive = $this->newPreparedStmt("update users set active = not active where id = ?");
    $this->stmtDelete = $this->newPreparedStmt("delete from users where id = ?");
    $this->stmtCreate = $this->newPreparedStmt("insert into users (id, username, email, password, first_name, last_name,
                                                active, updated_at, created_at)
                                                VALUES (NULL, ?, ?, ?, ?, ?, 1, NOW(), NOW()");
    $this->stmtUpdate = $this->newPreparedStmt("update users set username = ?, email = ?, password = ?, first_name = ?, last_name = ?,
                                                updated_at = NOW()
                                                where Id = ?");
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

  public function delete($userId)
  {
    $this->stmtDelete->execute([$userId]);
  }

  public function create($username, $email, $password, $first_name, $last_name)
  {
    $this->stmtCreate->execute([$username, $email, $password, $first_name, $last_name]);
  }

  public function update($username, $email, $password, $first_name, $last_name, $userId)
  {
    $this->stmtUpdate->execute([$username, $email, $password, $first_name, $last_name, $userId]);
  }
}
