<?php
class ErrorHandler
{
  public function __invoke($request, $response, $exception)
  {
    return $response
      ->withStatus(400)
      ->withJson(array('message' => $exception->getMessage(), 'error_code' => $exception->getCode()));
  }
}