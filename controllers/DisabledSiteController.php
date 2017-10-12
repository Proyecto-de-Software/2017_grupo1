<?php
class DisabledSiteController extends Controller
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