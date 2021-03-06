<?php
abstract class PDORepository
{
  const USERNAME = "grupo1";
  const PASSWORD = "YTIzNDE5ODJkOWQ4";
  const HOST = "localhost";
  const DB = "grupo1";

  protected function getConnection()
  {
    $u = self::USERNAME;
    $p = self::PASSWORD;
    $db = self::DB;
    $host = self::HOST;
    $connection = new PDO("mysql:dbname=$db;host=$host;charset=utf8", $u, $p);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
  }

  protected function newPreparedStmt($sql)
  {
    $connection = $this->getConnection();
    return $connection->prepare($sql);
  }

  protected function queryList($sql, $args = [])
  {
    $stmt = $this->newPreparedStmt($sql);
    $stmt->execute($args);
    return $stmt->fetchAll();
  }
}