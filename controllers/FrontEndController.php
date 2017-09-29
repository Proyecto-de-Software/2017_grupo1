<?php
class FrontEndController
{
  private $controllers;

  public function __construct()
  {
    $this->controllers = [];
  }

  public function addController($key, $controller)
  {
    $this->controllers[$key] = $controller;
  }

  public function getController($key)
  {
    return $this->controllers[$key];
  }
}
