<?php
class AdminController extends Controller
{
  private $view;

  public function __construct($adminView)
  {
    $this->view = $adminView;
  }

  public function showView($args)
  {
    $this->view->show();
  }
}