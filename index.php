<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "./private/autoloader.php";

$frontEndController = NULL;

function getFrontEndController()
{
  if (!isset($frontEndController)) {
    $frontEndController = new FrontEndController;
    $frontEndController->addController('index', new IndexController(new IndexView));
  }
  return $frontEndController;
}

getFrontEndController()-> getController('index')->showIndex();