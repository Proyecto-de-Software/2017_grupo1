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
    $this->stmtToggleActive = $this->newPreparedStmt("UPDATE users SET active = not active WHERE id = ?");
    $this->stmtDelete = $this->newPreparedStmt("DELETE FROM users WHERE id = ?");
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO users (id, username, email, password, first_name, last_name,
                                                active, updated_at, created_at)
                                                VALUES (NULL, ?, ?, ?, ?, ?, 1, NOW(), NOW()");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE users SET username = ?, email = ?, password = ?, first_name = ?, last_name = ?,
                                                updated_at = NOW()
                                                WHERE Id = ?");
  }

  public function getAll()
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users", []));
  }

  public function getAllActive($isActive)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users WHERE active = ?", [$isActive]));
  }

  public function getAllByName($name)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users WHERE name LIKE ?", [$ $name]));
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
