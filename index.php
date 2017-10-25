<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "./private/autoloader.php";

session_start();
$router = NULL;

function getRouter()
{
  if (!isset($router)) {
    $appConfig = new AppConfig;
    $userRepository = new UserRepository($appConfig);
    $pacientsRepository = new PacientsRepository($appConfig);
    $referenceDataService = new ReferenceDataService(
      new WaterTypeRepository,
      new HeatingTypeRepository,
      new DocumentTypeRepository,
      new SocialInsuranceRepository,
      new HomeTypeRepository
    );

    $indexView = new IndexView;
    $loginView = new LoginView;
    $indexController = new IndexController($indexView);

    TwigView::setAppConfig($appConfig);
    $router = new Router($appConfig, $userRepository);

    $router->addController('index', $indexController);
    $router->addController('login', new LoginController($loginView));
    $router->addController('do-login', new DoLoginController(new $indexView, $loginView, $userRepository));
    $router->addController('do-logout', new DoLogoutController($indexController));
    $router->addController('admin', new AdminController(new AdminView));
    $router->addController('admin_updated', new AdminUpdateController($indexView, $appConfig));

    $userListController = new UserListController(new UserListView, $userRepository, $appConfig);
    $router->addController('users_index', $userListController);
    $router->addController('user_new', new UserNewController(new NewUserView, $userRepository));
    $router->addController('user_added', new UserAddedController(new UserAddedView, $userRepository));
    $router->addController('user_form_update', new UserFormController(new EditUserView, $userRepository));
    $router->addController('user_updated', new UserUpdatedController(new UserUpdatedView, $userRepository));
    $router->addController('user_destroy', new UserDestroyedController(new UserDestroyedView, $userRepository));
    $router->addController('user_toggle_status', new UserToggleStatusController($userListController, $userRepository));

    $router->addController('pacients_index', new PacientListController(new PacientListView($referenceDataService), $pacientsRepository, $appConfig));
    $router->addController('pacient_new', new PacientNewController(new NewPacientView($referenceDataService), $pacientsRepository));
    $router->addController('pacient_added', new PacientAddedController(new PacientAddedView, $pacientsRepository));
    $router->addController('pacient_form_update', new PacientEditController(new EditPacientView($referenceDataService), $pacientsRepository));
    $router->addController('pacient_updated', new PacientUpdatedController(new PacientUpdatedView, $pacientsRepository));
    $router->addController('pacient_destroy', new PacientDestroyedController(new PacientDestroyedView, $pacientsRepository));
    $router->addController('pacient_demographic_data', new PacientEditController(new PacientDemographicDataView($referenceDataService), $pacientsRepository));
  }

  return $router;
}


if (isset($_GET['action']))
  getRouter()->getController($_GET['action'])->showView($_POST);
else
  getRouter()->getController('index')->showView($_POST);