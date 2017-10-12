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
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO users (username, email, password, first_name, last_name,
                                                active, updated_at, created_at)
                                                VALUES (?, ?, ?, ?, ?, 1, NOW(), NOW())");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE users SET username = ?, email = ?, password = ?, first_name = ?, last_name = ?,
                                                updated_at = NOW()
                                                WHERE Id = ?");
  }

  public function getAll()
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users", []));
  }

  public function getAllActive()
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users WHERE active = ?", [true]));
  }

  public function getAllByFilter($filter)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users WHERE (first_name LIKE '%$filter%' OR last_name LIKE '%$filter%' OR email LIKE '%$filter%' OR username LIKE '%$filter%') ORDER BY last_name, first_name ASC", [$filter]));
  }

  public function toggleActive($userId)
  {
      var_dump($userId);
    return $this->stmtToggleActive->execute([$userId]);
  }

  public function delete($userId)
  {
    return $this->stmtDelete->execute([$userId]);
  }

  public function create($username, $email, $password, $first_name, $last_name)
  {
    return $this->stmtCreate->execute([$username, $email, $password, $first_name, $last_name]);
  }

  public function update($username, $email, $password, $first_name, $last_name, $userId)
  {
    return $this->stmtUpdate->execute([$username, $email, $password, $first_name, $last_name, $userId]);
  }

  public function getUser($userId)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users where id = ?", [$userId]))[0];
  }
}

