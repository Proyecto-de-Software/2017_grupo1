<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "./private/autoloader.php";

$frontEndController = NULL;

function getFrontEndController()
{
  if (!isset($frontEndController)) {
    $frontEndController = new FrontEndController;
    $frontEndController->addController('index', new IndexController(new IndexView));
    $frontEndController->addController('login', new LoginController(new LoginView));
    $frontEndController->addController('admin', new AdminController(new AdminView));
    $frontEndController->addController('users_list', new UserController(new UserListView, new UserRepository));
    $frontEndController->addController('pacient_index', new PacientsController(new PacientsListView, new PacientsRepository));
  }
  return $frontEndController;
}

if (isset($_GET['action'])) {
	getFrontEndController()-> getController($_GET['action'])->showView();
} else
{
	getFrontEndController()-> getController('index')->showView();
}