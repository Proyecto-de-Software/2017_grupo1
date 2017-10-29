<?php
class ErrorHandler
{
  public function __invoke($request, $response, $exception)
  {
    return $response
      ->withStatus(400)
      ->withHeader('Content-Type', 'text/plain')
      ->write($exception->getMessage());
  }
}