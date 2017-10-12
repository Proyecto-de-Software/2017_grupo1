<?php
require_once "./vendor/Twig/lib/Twig/Autoloader.php";
require_once "./controllers/FrontEndController.php";
require_once "./controllers/IndexController.php";
require_once "./controllers/UserController.php";
require_once "./controllers/LoginController.php";
require_once "./controllers/AdminController.php";
require_once "./controllers/PacientsController.php";
<<<<<<< HEAD
require_once "./controllers/PacientDemographicDataController.php";

=======
require_once "./controllers/DisabledSiteController.php";
>>>>>>> 61c1a7b1d7983e89af692f700016854d91ff4a7a

require_once "./models/PDORepository.php";
require_once "./models/UserRepository.php";
require_once "./models/PacientsRepository.php";
require_once "./models/User.php";
require_once "./models/Pacient.php";
<<<<<<< HEAD
require_once "./models/Demographic_data.php";
require_once "./models/DemographicDataRepository.php";


=======
require_once "./models/AppConfig.php";
>>>>>>> 61c1a7b1d7983e89af692f700016854d91ff4a7a

require_once "./views/TwigView.php";
require_once "./views/IndexView.php";
require_once "./views/TwigView.php";
require_once "./views/IndexView.php";
require_once "./views/LoginView.php";
require_once "./views/AdminView.php";
require_once "./views/DisabledSiteView.php";

require_once "./views/UsersView.php";
require_once "./views/UserNewView.php"; //alta//
require_once "./views/UserAddedView.php"; //alta//
require_once "./views/UserFormView.php"; //modificacion//
require_once "./views/UserUpdatedView.php"; //modificacion//
require_once "./views/UserDestroyedView.php"; //baja

require_once "./views/PacientViews.php";
require_once "./views/PacientNewView.php"; //alta//
require_once "./views/PacientAddedView.php";//alta//
require_once "./views/PacientFormView.php"; //modificacion//
require_once "./views/PacientUpdatedView.php";//modificacion//
require_once "./views/PacientDestroyedView.php"; //baja
require_once "./views/PacientDemographicDataView.php"; //datos demograficos de un paciente


