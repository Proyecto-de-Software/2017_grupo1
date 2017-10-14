<?php
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

class UserAddedController extends UserController
{
  public function showView($args)
  {
    if ($this->getRepository()->create($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name']))
      $this->getView()->show();

  }
}

class UserUpdatedController extends UserController
{
  public function showView($args)
  {
    if ($this->getRepository()->update($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name'], $args['id']))
      $this->getView()->show();
  }
}

class UserFormController extends UserController
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getUser($args['id']));
  }
}

class UserListController extends UserController
{
  private $appConfig;

  public function __construct($view, $repository, $appConfig)
  {
    parent::__construct($view, $repository);
    $this->appConfig = $appConfig;
  }

  public function showView($args)
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

  public function showView($args)
  {
    $this->repository->toggleActive($args['id']);
    $this->userListController->showView([]);
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
