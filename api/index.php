<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../vendor/autoload.php";
require_once "validations.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$app->get("/", function (Request $request, Response $response) {
  return $response->withStatus(200)->withHeader('Content-Type', 'text/html')->getBody()->write(file_get_contents('index.html'));
});

$app->get("/turnos[/[{fecha}]]", function (Request $request, Response $response, $args) {
  $body = $response->getBody();
  $date =  $request->getAttribute('fecha', date('d-m-Y'));

  if (!validateDate($date, $body))
    return $response->withStatus(400);

    $body->write("<html> <body>");
      $body->write("<h1> Grupo 1 - API de Turnos - Proyecto de Software </h1>");
      $body->write("La fecha recibida es: $date");
    $body->write("</body> </html>");
  return $response->withStatus(200);
});

$app->post("/turnos", function (Request $request, Response $response, $args) {
  $body = $response->getBody();
  $date =  $request->getParsedBodyParam('fecha', date('d-m-Y'));
  $time = $request->getParsedBodyParam('hora');
  $dni = $request->getParsedBodyParam('dni');

  if (!validateDate($date, $body))
    return $response->withStatus(400);

    if (!validateTime($time, $body))
    return $response->withStatus(400);

  if (!validateDni($dni, $body))
    return $response->withStatus(400);

  $body->write("<html> <body>");
    $body->write("<h1> Grupo 1 - API de Turnos - Proyecto de Software </h1>");
    $body->write("Los parametros recibidos son:");
    $body->write("<ul>");
      $body->write("<li> DNI: " . $request->getParsedBodyParam('dni') . "</li>");
      $body->write("<li> Fecha: " . $request->getParsedBodyParam('fecha') . "</li>");
      $body->write("<li> Hora: " . $request->getParsedBodyParam('hora') . "</li>");
    $body->write("</ul>");
  $body->write("</body> </html>");
  return $response->withStatus(200);
});

$app->run();