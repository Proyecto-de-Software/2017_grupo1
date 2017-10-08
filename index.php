<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "./private/autoloader.php";

$frontEndController = NULL;

function getFrontEndController()
{
  if (!isset($frontEndController)) {
    $userRepository = new UserRepository;
    $pacientsRepository = new PacientsRepository;
    $frontEndController = new FrontEndController;
    $frontEndController->addController('index', new IndexController(new IndexView));
    $frontEndController->addController('login', new LoginController(new LoginView));
    $frontEndController->addController('admin', new AdminController(new AdminView));
    $frontEndController->addController('user_new', new UserController(new UserNewView, $userRepository));
    $frontEndController->addController('users_index', new UserListController(new UserListView, $userRepository));
    $frontEndController->addController('user_added', new UserAddedController(new UserAddedView, $userRepository));
    $frontEndController->addController('pacient_index', new PacientsController(new PacientsListView, $pacientsRepository));
    $frontEndController->addController('paciente_new', new PacientsController(new PacientsFormView, $pacientsRepository));
  }
  return $frontEndController;
}

if (isset($_GET['action'])) {
	getFrontEndController()-> getController($_GET['action'])->showView($_POST);
} else
{
	getFrontEndController()-> getController('index')->showView();
}