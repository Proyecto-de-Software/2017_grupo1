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

  public function getIsAdmin()
  {
    if (!isset($_SESSION['isAdmin']))
      return false;

    return $_SESSION['isAdmin'];
  }

  public function getUserId()
  {
    if ($this->getIsLoggedIn())
      return $_SESSION['userId'];
    else
      return -1;
  }
}