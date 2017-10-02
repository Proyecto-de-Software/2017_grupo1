<?php
class LoginController
{
  private $view;

  public function __construct($loginView) {
    $this->view = $loginView;
  }

  public function showView()
  {
    $this->view->show();
  }
}
