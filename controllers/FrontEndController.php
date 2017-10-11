<?php
class FrontEndController
{
  private $controllers;
  private $appConfig;
  private $disabledSiteController;

  public function __construct($appConfig)
  {
    $this->disabledSiteController = new DisabledSiteController();
    $this->appConfig = $appConfig;
    $this->controllers = [];
  }

  public function addController($key, $controller)
  {
    $this->controllers[$key] = $controller;
  }

  public function getController($key)
  {
    if ($this->appConfig->getIsSiteEnabled())
      return $this->controllers[$key];
    else
      return $this->disabledSiteController;
  }
}
