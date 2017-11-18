<?php
require_once "./vendor/Twig/lib/Twig/Autoloader.php";

require_once "./private/controllers/Controller.php";
require_once "./private/controllers/Router.php";
require_once "./private/controllers/IndexController.php";
require_once "./private/controllers/UserController.php";
require_once "./private/controllers/LoginController.php";
require_once "./private/controllers/AdminController.php";
require_once "./private/controllers/PacientsController.php";
require_once "./private/controllers/DisabledSiteController.php";
require_once "./private/controllers/NonAuthorizedController.php";
require_once "./private/controllers/ClinicalHistoryController.php";
require_once "./private/controllers/ReportsController.php";

require_once "./private/models/PDORepository.php";
require_once "./private/models/UserRepository.php";
require_once "./private/models/PacientsRepository.php";
require_once "./private/models/ReferenceData.php";
require_once "./private/models/ReferenceDataRepository.php";
require_once "./private/models/ReferenceDataService.php";
require_once "./private/models/ClinicalHistoryRepository.php";

require_once "./private/models/User.php";
require_once "./private/models/Pacient.php";
require_once "./private/models/AppConfig.php";
require_once "./private/models/ClinicalHistory.php";

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
require_once "./private/views/ClinicalHistoryView.php";
require_once "./private/views/ReportsView.php";
require_once "./private/views/DemographicDataReportView.php";
require_once "./private/views/GrowthReportView.php";

require_once "./private/reports/DemographicDataReport.php";
require_once "./private/reports/PacientsBySocialInsuranceReport.php";
require_once "./private/reports/PacientsByWaterTypeReport.php";
require_once "./private/reports/PacientsByHeatingTypeReport.php";
require_once "./private/reports/PacientsByHomeTypeReport.php";
require_once "./private/reports/PacientsByDocumentTypeReport.php";
