<?php
class NonAuthorizedController extends Controller
{
  private $view;

    public function __construct()
    {
      $this->view = new NonAuthorizedView;
    }

    public function showView($args)
    {
      $this->view->show($args);
    }
}