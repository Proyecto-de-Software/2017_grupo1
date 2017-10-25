<?php
require_once "./private/vendor/Twig/lib/Twig/Autoloader.php";

require_once "./private/controllers/Controller.php";
require_once "./private/controllers/Router.php";
require_once "./private/controllers/IndexController.php";
require_once "./private/controllers/UserController.php";
require_once "./private/controllers/LoginController.php";
require_once "./private/controllers/AdminController.php";
require_once "./private/controllers/PacientsController.php";
require_once "./private/controllers/DisabledSiteController.php";
require_once "./private/controllers/NonAuthorizedController.php";

require_once "./private/models/PDORepository.php";
require_once "./private/models/UserRepository.php";
require_once "./private/models/PacientsRepository.php";
require_once "./private/models/ReferenceData.php";
require_once "./private/models/ReferenceDataRepository.php";
require_once "./private/models/DocumentTypeRepository.php";
require_once "./private/models/HomeTypeRepository.php";
require_once "./private/models/HeatingTypeRepository.php";
require_once "./private/models/WaterTypeRepository.php";
require_once "./private/models/SocialInsuranceRepository.php";
require_once "./private/models/ReferenceDataService.php";
require_once "./private/models/User.php";
require_once "./private/models/Pacient.php";
require_once "./private/models/AppConfig.php";

require_once "./private/Session.php";
require_once "./private/UserSession.php";

require_once "./private/views/TwigView.php";
require_once "./private/views/IndexView.php";
require_once "./private/views/LoginView.php";
require_once "./private/views/AdminView.php";
require_once "./private/views/DisabledSiteView.php";
require_once "./private/views/NonAuthorizedView.php";
require_once "./private/views/InvalidArgsView.php";
require_once "./private/views/ErrorMessageView.php";

require_once "./private/views/UserListView.php";
require_once "./private/views/UserAddedView.php";
require_once "./private/views/UserFormView.php";
require_once "./private/views/UserUpdatedView.php";
require_once "./private/views/UserDestroyedView.php";

require_once "./private/views/PacientListView.php";
require_once "./private/views/PacientAddedView.php";
require_once "./private/views/PacientFormView.php";
require_once "./private/views/PacientUpdatedView.php";
require_once "./private/views/PacientDestroyedView.php";
require_once "./private/views/PacientDemographicDataView.php";