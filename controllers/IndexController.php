<?php
class IndexController extends Controller
{
  private $view;

  public function __construct($indexView) {
    $this->view = $indexView;
  }

  public function showView($args)
  {
    $this->view->show();
  }
}
