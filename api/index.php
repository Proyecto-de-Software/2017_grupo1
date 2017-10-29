<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../vendor/autoload.php";
require_once "autoloader.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$appointmentsRepository = \APIHelper::getAppointmentsRepository();
$patientsRepository = new \PacientsRepository(new \AppConfig);

$app = new \Slim\App;
$container = $app->getContainer();
$container['errorHandler'] = function ($container) {
  return new \ErrorHandler;
};

$app->get("/", function (Request $request, Response $response)
 {
  return $response->withStatus(200)->withHeader('Content-Type', 'text/html')->getBody()->write(file_get_contents('index.html'));
});

$app->get("/consulta-turnos[/[{fecha}]]", function (Request $request, Response $response, $args) use ($appointmentsRepository)
{
  $date =  $request->getAttribute('fecha', date('d-m-Y'));
  \APIHelper::isValidDate($date);
  return $response->withStatus(200)->withJson($appointmentsRepository->getAppointments($date));
});

$app->get("/turnos[/[{fecha}]]", function (Request $request, Response $response, $args) use ($appointmentsRepository)
{
  $date =  $request->getAttribute('fecha', date('d-m-Y'));
  \APIHelper::isValidDate($date);
  return $response->withStatus(200)->withJson($appointmentsRepository->getAvailableAppointments($date));
});

$app->post("/turnos", function (Request $request, Response $response, $args) use ($appointmentsRepository, $patientsRepository)
{
  $date = $request->getParsedBodyParam('fecha', date('d-m-Y'));
  $time = $request->getParsedBodyParam('hora');
  $dni = $request->getParsedBodyParam('dni');
  \APIHelper::isValidDate($date);
  \APIHelper::isValidTime($time);
  \APIHelper::isValidDni($dni);
  $appointment = array('dni' => $dni, 'hora' => $time, 'fecha' => $date, 'id' => '');

  $success = $patientsRepository->dniExists($dni);
  if ($success)
  {
    $success = $appointmentsRepository->appoint($date, $time, $dni);
    if ($success)
    {
      $id_turno = $appointmentsRepository->getLastId();
      $appointment['id'] = $id_turno;
      $message = "Te confirmamos el turno nro $id_turno para $dni, a las $time del dia $date";
    }
    else
    {
      $message = 'El turno solicitado ya se encuentra ocupado';
    }
  }
  else
  {
    $message = "El DNI $dni no existe en el sistema";
  }

  return $response->withStatus(200)->withJson(array('success' => $success, 'message' => $message, 'appointment' => $appointment));
});

$app->run();