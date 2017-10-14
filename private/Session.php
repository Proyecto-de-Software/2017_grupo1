<?php
class Session
{
  public function getIsLoggedIn()
  {
    return isset($_SESSION['userId']);
  }

  public function getUserName()
  {
    if (isset($_SESSION['userName']))
      return $_SESSION['userName'];
    else
      return '';
  }

  public function hasPermission($action)
  {
    return true;
  }
}