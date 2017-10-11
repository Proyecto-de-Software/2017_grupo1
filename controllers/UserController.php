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
//alta//
class UserAddedController extends UserController
{
  public function showView($args)
  {
    if ($this->getRepository()->create($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name']))
      $this->getView()->show();

  }
}

//modificacion//
class UserUpdatedController extends UserController
{
  public function showView($args)
  {
    if ($this->getRepository()->update($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name']))
      $this->getView()->show();
  }
}

class UserFormController extends UserController //para el formulario de modificacion de datos//
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getUser($args['id']));
  }
}

//listado
class UserListController extends UserController
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getAllActive());
  }
}

class UserDestroyedController extends UserController
{
  public function showView($args)
  {
    if ($this->getRepository()->delete($args['id']))
      $this->getView()->show();
  }
}
