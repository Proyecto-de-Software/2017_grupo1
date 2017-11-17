<?php
class Router
{
  private $controllers;
  private $appConfig;
  private $disabledSiteController;
  private $nonAuthorizedController;
  private $userRepository;
  private static $router;
  private static $admin_actions = array('admin', 'admin_updated');

  private function getUserSession()
  {
    return new UserSession($this->userRepository);
  }

  public function __construct($appConfig, $userRepository)
  {
    $this->disabledSiteController = new DisabledSiteController;
    $this->nonAuthorizedController = new NonAuthorizedController;
    $this->appConfig = $appConfig;
    $this->controllers = [];
    $this->userRepository = $userRepository;
  }

  public function addController($key, $controller)
  {
    $this->controllers[$key] = $controller;
  }

  public function getController($key)
  {
    if (!$this->appConfig->getIsSiteEnabled())
    {
      if (($this->getUserSession()->hasRole('ADMINISTRADOR')) && (in_array($key, self::$admin_actions)))
        return $this->controllers[$key];
      else
        return $this->disabledSiteController;
    }

    if (!$this->getUserSession()->hasPermission($key))
      return $this->nonAuthorizedController;

    return $this->controllers[$key];
  }

  static function getRouter()
  {
    if (!isset(self::$router)) {
      $appConfig = new AppConfig;
      $userRepository = new UserRepository($appConfig);
      $pacientsRepository = new PacientsRepository($appConfig);
      $clinicalHistoryRepository = new ClinicalHistoryRepository($appConfig);

      $socialInsuranceRepository = new APIReferenceDataRepository("obra-social");
      $waterTypeRepository = new APIReferenceDataRepository("tipo-agua");
      $heatingTypeRepository = new APIReferenceDataRepository("tipo-calefaccion");
      $homeTypeRepository = new APIReferenceDataRepository("tipo-vivienda");
      $documentTypeRepository = new APIReferenceDataRepository("tipo-documento");
      $referenceDataService = new ReferenceDataService(
        $waterTypeRepository,
        $heatingTypeRepository,
        $documentTypeRepository,
        $socialInsuranceRepository,
        $homeTypeRepository
      );

      $indexView = new IndexView;
      $loginView = new LoginView;
      $indexController = new IndexController($indexView);

      TwigView::setAppConfig($appConfig);
      self::$router = new Router($appConfig, $userRepository);

      self::$router->addController('index', $indexController);
      self::$router->addController('login', new LoginController($loginView));
      self::$router->addController('do-login', new DoLoginController(new $indexView, $loginView, $userRepository));
      self::$router->addController('do-logout', new DoLogoutController($indexController));
      self::$router->addController('admin', new AdminController(new AdminView));
      self::$router->addController('admin_updated', new AdminUpdateController($indexView, $appConfig));

      $reportsController = new ReportsController;
      $reportsController->addReport('Pacientes por Obra Social', new PacientsBySocialInsuranceReport($pacientsRepository, $socialInsuranceRepository));
      $reportsController->addReport('Pacientes por Tipo de Agua', new PacientsByWaterTypeReport($pacientsRepository, $waterTypeRepository));
      $reportsController->addReport('Pacientes por Tipo de Calefacción', new PacientsByHeatingTypeReport($pacientsRepository, $heatingTypeRepository));
      $reportsController->addReport('Pacientes por Tipo de Vivienda', new PacientsByHomeTypeReport($pacientsRepository, $homeTypeRepository));
      $reportsController->addReport('Pacientes por Tipo de Documento', new PacientsByDocumentTypeReport($pacientsRepository, $documentTypeRepository));
      self::$router->addController('reports_index', $reportsController);

      $userListController = new UserListController(new UserListView, $userRepository, $appConfig);
      self::$router->addController('users_index', $userListController);
      self::$router->addController('user_new', new UserNewController(new NewUserView, $userRepository));
      self::$router->addController('user_added', new UserAddedController(new UserAddedView, $userRepository));
      self::$router->addController('user_form_update', new UserFormController(new EditUserView, $userRepository));
      self::$router->addController('user_updated', new UserUpdatedController(new UserUpdatedView, $userRepository));
      self::$router->addController('user_destroy', new UserDestroyedController(new UserDestroyedView, $userRepository));
      self::$router->addController('user_toggle_status', new UserToggleStatusController($userListController, $userRepository));

      self::$router->addController('pacients_index', new PacientListController(new PacientListView($referenceDataService), $pacientsRepository, $appConfig));
      self::$router->addController('pacient_new', new PacientNewController(new NewPacientView($referenceDataService), $pacientsRepository));
      self::$router->addController('pacient_added', new PacientAddedController(new PacientAddedView, $pacientsRepository));
      self::$router->addController('pacient_demographic_data', new PacientEditController(new PacientDemographicDataView($referenceDataService), $pacientsRepository));
      self::$router->addController('pacient_form_update', new PacientEditController(new EditPacientView($referenceDataService), $pacientsRepository));
      self::$router->addController('pacient_updated', new PacientUpdatedController(new PacientUpdatedView, $pacientsRepository));
      self::$router->addController('pacient_destroy', new PacientDestroyedController(new PacientDestroyedView, $pacientsRepository));

      $clinicalHistoryListController = new ClinicalHistoryListController(new ClinicalHistoryListView, $clinicalHistoryRepository);
      self::$router->addController('clinical_history_index', $clinicalHistoryListController);
      self::$router->addController('clinical_history_form_new', new ClinicalHistoryNewController(new NewClinicalHistoryView, $clinicalHistoryRepository));
      self::$router->addController('clinical_history_added', new ClinicalHistoryAddedController(new ClinicalHistoryAddedView, $clinicalHistoryRepository));
      self::$router->addController('clinical_history_form_update', new ClinicalHistoryEditController(new EditClinicalHistoryView, $clinicalHistoryRepository));
      self::$router->addController('clinical_history_updated', new ClinicalHistoryUpdatedController(new ClinicalHistoryUpdatedView, $clinicalHistoryRepository));
      self::$router->addController('clinical_history_destroy', new ClinicalHistoryDestroyedController(new ClinicalHistoryDestroyedView, $clinicalHistoryRepository));
    }

    return self::$router;
  }
}
