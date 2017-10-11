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
    $frontEndController->addController('users_index', new UserListController(new UserListView, $userRepository));
    $frontEndController->addController('pacients_index', new PacientListController(new PacientsListView, $pacientsRepository));

    //alta
    $frontEndController->addController('user_new', new UserController(new UserNewView, $userRepository)); 
    $frontEndController->addController('user_added', new UserAddedController(new UserAddedView, $userRepository));
    //modificacion
    $frontEndController->addController('user_form_update', new UserFormController(new UserFormView, $userRepository));
    $frontEndController->addController('user_updated', new UserUpdatedController(new UserUpdatedView, $userRepository));
    //baja
    $frontEndController->addController('user_destroyed', new UserDestroyedController(new UserDestroyedView, $userRepository));


    //alta
    $frontEndController->addController('pacient_new', new PacientsController(new PacientNewView, $pacientsRepository));
    $frontEndController->addController('pacient_added', new PacientAddedController(new PacientAddedView, $pacientsRepository));
    //modificacion
    $frontEndController->addController('pacient_form_update', new PacientFormController(new PacientsFormView, $pacientsRepository));
    $frontEndController->addController('pacient_updated', new PacientUpdatedController(new PacientUpdatedView, $pacientsRepository));
    
  }
  return $frontEndController;
}

if (isset($_GET['action'])) {
	getFrontEndController()-> getController($_GET['action'])->showView($_POST);
} else
{
	getFrontEndController()-> getController('index')->showView();
}