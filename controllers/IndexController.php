<?php
class IndexController
{
  private $view;

  public function __construct($indexView) {
    $this->view = $indexView;
  }

  public function showIndex()
  {
    $this->view->show();
  }
}
