<?php
abstract class UsersController extends Controller
{
  private $view;

  public function __construct($view)
  {
    $this->view = $view;
  }

  protected function doShowView($args)
  {
    $this->getView()->show($args);
  }

  protected function getView()
  {
    return $this->view;
  }
}

class UserNewController extends UsersController
{
}

abstract class UsersCRUDController extends UsersController
{
  private $repository;

  public function __construct($view, $repository)
  {
    parent::__construct($view);
    $this->repository = $repository;
  }

  protected function getRepository()
  {
    return $this->repository;
  }

  protected function checkArgs($args)
  {
    if (!isset($args['username']))
      return false;

    if (!isset($args['email']))
      return false;

    if (!isset($args['password']))
      return false;

    if (!isset($args['first_name']))
      return false;

    if (!isset($args['last_name']))
      return false;

    if (empty($args['username']))
      return false;

    if (empty($args['email']))
      return false;

    if (empty($args['password']))
      return false;

    if (empty($args['first_name']))
      return false;

    if (empty($args['last_name']))
      return false;

    return true;
  }
}

class UserAddedController extends UsersCRUDController
{
  protected function doShowView($args)
  {
    if ($this->getRepository()->create($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name']))
      $this->getView()->show();
  }
}

class UserUpdatedController extends UsersCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return parent::checkArgs($args);
  }

  protected function doShowView($args)
  {
    if ($this->getRepository()->update($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name'], $args['id']))
      $this->getView()->show();
  }
}

class UserFormController extends UsersCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;
  }

  protected function doShowView($args)
  {
    $this->getView()->show($this->getRepository()->getUser($args['id']));
  }
}

class UserListController extends UsersCRUDController
{
  private $appConfig;

  public function __construct($view, $repository, $appConfig)
  {
    parent::__construct($view, $repository);
    $this->appConfig = $appConfig;
  }

  protected function doShowView($args)
  {
    if (!isset($args['page']))
      $page = 1;
    else
      $page = $args['page'];

    if (!isset($args['filter']) || empty($args['filter']))
    {
      $data = $this->getRepository()->getAll($page);
      $data_count = $this->getRepository()->getUserCount();
    }
    else
    {
      $data = $this->getRepository()->getAllByFilter($args['filter'], $page);
      $data_count = count($data);
    }

    $this->getView()->show($data, round($data_count / $this->appConfig->getPage_row_size()));
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

  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;
  }

  protected function doShowView($args)
  {
    $this->repository->toggleActive($args['id']);
    $this->userListController->showView([]);
  }
}

class UserDestroyedController extends UsersController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;
  }

  protected function doShowView($args)
  {
    if ($this->getRepository()->delete($args['id']))
      $this->getView()->show();
  }
}
