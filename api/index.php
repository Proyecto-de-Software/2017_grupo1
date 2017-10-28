<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../vendor/autoload.php";
require_once "autoloader.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$repository = new AppointmentsRepository;
$app = new \Slim\App;
$app->get("/", function (Request $request, Response $response) {
  return $response->withStatus(200)->withHeader('Content-Type', 'text/html')->getBody()->write(file_get_contents('index.html'));
});

$app->get("/turnos[/[{fecha}]]", function (Request $request, Response $response, $args) use ($repository) {
  $body = $response->getBody();
  $date =  $request->getAttribute('fecha', date('d-m-Y'));

  if (!validateDate($date, $body))
    return $response->withHeader('Content-Type', 'text/plain')->withStatus(400);

  return $response->withStatus(200)->withJson($repository->getAppointments($date));
});

$app->post("/turnos", function (Request $request, Response $response, $args) use ($repository) {
  $body = $response->getBody();
  $date = $request->getParsedBodyParam('fecha', date('d-m-Y'));
  $time = $request->getParsedBodyParam('hora');
  $dni = $request->getParsedBodyParam('dni');

  if (!validateDate($date, $body))
    return $response->withHeader('Content-Type', 'text/plain')->withStatus(400);

  if (!validateTime($time, $body))
    return $response->withHeader('Content-Type', 'text/plain')->withStatus(400);

  if (!validateDni($dni, $body))
    return $response->withHeader('Content-Type', 'text/plain')->withStatus(400);

    try
    {
      $success = $repository->appoint($date, $time, $dni);
      if ($success)
        $message = "El turno fue asignado correctamente para DNI: $dni en la fecha $date $time";
      else
        $message = 'El turno solicitado ya se encuentra ocupado';

      return $response->withStatus(200)->withJson(array('success' => $success, 'message' => $message));
    }
    catch(\Exception $e)
    {
      return $response->withHeader('Content-Type', 'text/plain')->withStatus(500)->getBody()->write($e->getMessage());
    }
});

$app->run();