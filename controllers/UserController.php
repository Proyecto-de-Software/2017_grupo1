<?php
class UserController
{
  private $view;
  private $repository;

  public function __construct($view, $repository)
  {
    $this->repository = $repository;
    $this->view = $view;
  }

  public function showView()
  {
    $this->getView()->show();
  }

  protected function getView()
  {
    return $this->view;
  }

  protected function getRepository()
  {
    return $this->repository;
  }
}

class UserListController extends UserController
{

  public function showView()
  {
    $this->getView()->show($this->getRepository()->getAll());
  }
}