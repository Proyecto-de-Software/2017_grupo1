<?php
class DisabledSiteController
{
  private $view;

  public function __construct()
  {
    $this->view = new DisabledSiteView;
  }

  public function showView($args)
  {
    $this->view->show($args);
  }
}