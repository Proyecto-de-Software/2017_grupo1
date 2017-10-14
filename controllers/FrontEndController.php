<?php
class FrontEndController
{
  private $controllers;
  private $appConfig;
  private $disabledSiteController;
  private $nonAuthorizedController;

  private function getSession()
  {
    return new Session();
  }

  public function __construct($appConfig)
  {
    $this->disabledSiteController = new DisabledSiteController;
    $this->nonAuthorizedController = new NonAuthorizedController;
    $this->appConfig = $appConfig;
    $this->controllers = [];
  }

  public function addController($key, $controller)
  {
    $this->controllers[$key] = $controller;
  }

  public function getController($key)
  {
    if (!$this->appConfig->getIsSiteEnabled())
      return $this->disabledSiteController;

    if (!$this->getSession()->hasPermission($key))
      return $this->nonAuthorizedController;

    return $this->controllers[$key];
  }
}
