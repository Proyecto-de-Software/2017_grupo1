<?php
class AdminController
{
  private $view;

  public function __construct($adminView) {
    $this->view = $adminView;
  }

  public function showView()
  {
    $this->view->show();
  }
}