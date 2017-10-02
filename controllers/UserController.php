<?php
class UserController {
  private $view;
  private $repository;

  public function __construct($view, $repository) {
    $this->repository = $repository;
    $this->view = $view;
  }

  public function showView() {
    $this->view->show($this->repository->getAll());
  }
}