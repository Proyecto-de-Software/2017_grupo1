<?php
class LoginController extends Controller
{
  private $view;

  public function __construct($loginView)
  {
    $this->view = $loginView;
  }

  public function showView($args)
  {
    $this->view->show();
  }
}

class DoLoginController extends Controller
{
  private $indexView;
  private $loginView;
  private $userRepository;

  public function __construct($indexView, $loginView, $userRepository)
  {
    $this->indexView = $indexView;
    $this->loginView = $loginView;
    $this->userRepository = $userRepository;
  }

  public function showView($args)
  {
    if ($this->userRepository->containsUser($args['username'], $args['password']))
    {
      $user = $this->userRepository->findUser($args['username'], $args['password']);
      $_SESSION['userId'] = $user->getId();
      $_SESSION['userName'] = $user->getFull_Name();
      $this->indexView->show();
    }
    else
      $this->loginView->show(true);
  }
}

class DoLogoutController extends Controller
{
  private $indexController;

  public function __construct($indexController)
  {
    $this->indexController = $indexController;
  }

  public function showView($args)
  {
    session_unset();
    session_destroy();
    $this->indexController->showView($args);
  }
}
