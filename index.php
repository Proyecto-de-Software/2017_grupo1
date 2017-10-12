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
<<<<<<< HEAD
    $demographicdataRepository = new DemographicDataRepository;
    $frontEndController = new FrontEndController;
=======
    $appConfig = new AppConfig();
    TwigView::setAppConfig($appConfig);
    $frontEndController = new FrontEndController($appConfig);
>>>>>>> 61c1a7b1d7983e89af692f700016854d91ff4a7a

    $frontEndController->addController('index', new IndexController(new IndexView));
    $frontEndController->addController('login', new LoginController(new LoginView));
    $frontEndController->addController('admin', new AdminController(new AdminView));

    $userListController = new UserListController(new UserListView, $userRepository);
    $frontEndController->addController('users_index', $userListController);
    $frontEndController->addController('user_new', new UserController(new UserNewView, $userRepository));
    $frontEndController->addController('user_added', new UserAddedController(new UserAddedView, $userRepository));
    $frontEndController->addController('user_form_update', new UserFormController(new UserFormView, $userRepository));
    $frontEndController->addController('user_updated', new UserUpdatedController(new UserUpdatedView, $userRepository));
    $frontEndController->addController('user_destroyed', new UserDestroyedController(new UserDestroyedView, $userRepository));
    $frontEndController->addController('user_toggle_status', new UserToggleStatusController($userListController, $userRepository));

    $frontEndController->addController('pacients_index', new PacientListController(new PacientsListView, $pacientsRepository));
    $frontEndController->addController('pacient_new', new PacientsController(new PacientNewView, $pacientsRepository));
    $frontEndController->addController('pacient_added', new PacientAddedController(new PacientAddedView, $pacientsRepository));
    $frontEndController->addController('pacient_form_update', new PacientEditController(new PacientsFormView, $pacientsRepository));
    $frontEndController->addController('pacient_updated', new PacientUpdatedController(new PacientUpdatedView, $pacientsRepository));
    $frontEndController->addController('pacient_destroyed', new PacientDestroyedController(new PacientDestroyedView, $pacientsRepository));
    $frontEndController->addController('pacient_demographic_data', new DemographicDataListController(new PacientDemographicDataView, $demographicdataRepository));


  }
  return $frontEndController;
}

if (isset($_POST)) {
  echo '$_POST ----->', var_dump($_POST);
  echo '<br>';
}

if (isset($_GET)) {
  echo '$_GET ----->', var_dump($_GET);
  echo '<br>';
}

if (isset($_SESSION))
  echo '$_SESSION ----->', var_dump($_SESSION);

echo '<br>';

if (isset($_GET['action']))
  getFrontEndController()->getController($_GET['action'])->showView($_POST);
else
  getFrontEndController()->getController('index')->showView([]);