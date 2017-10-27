<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../vendor/autoload.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$app->get("/", function (Request $request, Response $response) {
  $response->withStatus(200)->getBody()->write("<html> <body> <h1> Grupo 1 - API de Turnos - Proyecto de Software </h1> </body> </html>");
  return $response;
});

$app->get("/turnos/{fecha}", function (Request $request, Response $response, $args) {
  $response->withStatus(200)->getBody()->write("<html> <body> <h1> Grupo 1 - API de Turnos - Proyecto de Software </h1> </body> </html>");
  $response->getBody()->write("El parametro recibido es: $args[fecha]");
  return $response;
});

$app->post("/turnos", function (Request $request, Response $response, $args) {
  $body = $response->getBody();
  $body->write("<html> <body> <h1> Grupo 1 - API de Turnos - Proyecto de Software </h1>");
  $body->write("Los parametros recibidos son:");
  $body->write("<ul>");
    $body->write("<li> DNI: " . $request->getParsedBodyParam('dni') . "</li>");
    $body->write("<li> Fecha: " . $request->getParsedBodyParam('fecha') . "</li>");
    $body->write("<li> Hora: " . $request->getParsedBodyParam('hora') . "</li>");
  $body->write("</ul>");
  $body->write("</body> </html>");
  $response->withStatus(200);
  return $response;
});

$app->run();