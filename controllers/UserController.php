0<?php
class UserController extends Controller
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
    if ($this->getRepository()->update($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name'], $args['id']))
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

    if (empty($args['filter'])){
      $this->getView()->show($this->getRepository()->getAllActive());
    } else
    {
      $this->getView()->show($this->getRepository()->getAllByFilter($args['filter']));
    }
  }
}

class UserToggleStatusController
{
  private $userListController;
  private $repository;

  public function __construct($userListController, $repository)
  {
    $this->repository = $repository;
    $this->userListController = $userListController;
  }

  public function showView($args)
  {
    $this->repository->toggleActive($args['id']);
    $this->userListController->showView([]);
  }
}

//baja
class UserDestroyedController extends UserController
{
  public function showView($args)
  {
    if ($this->getRepository()->delete($args['id']))
      $this->getView()->show();
  }
}
