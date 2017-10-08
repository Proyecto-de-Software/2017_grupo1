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

  public function showView($args)
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

class UserAddedController extends UserController 
{
  public function showView($args) 
  {
    if ($this->getRepository()->create($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name'])) 
    $this->getView()->show(); 

  }
}

class UserListController extends UserController
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getAllActive());
  }
}