<?php
class PacientsController
{
  private $view;
  private $repository;

  public function __construct($view, $repository)
  {
    $this->repository = $repository;
    $this->view = $view;
  }

  public function showView($args)
  {
    $this->getView()->show($args);
  }

  protected function getView()
  {
    return $this->view;
  }

  protected function getRepository()
  {
    return $this->repository;
  }
}

class PacientAddedController extends PacientsController
{
  private function canCreate($args)
  {
    return $this->getRepository()->create(
      $args['first_name'],
      $args['last_name'],
      $args['birth_date'],
      $args['gender'],
      $args['doc_type'],
      $args['dni'],
      $args['address'],
      $args['phone'],
      $args['id_medical_insurance']
    );
  }

  public function showView($args)
  {
    if ($this->canCreate($args))
      $this->getView()->show();
  }
}

class PacientUpdatedController extends PacientsController
{
  private function canUpdate($args)
  {
    return $this->getRepository()->update(
      $args['first_name'],
      $args['last_name'],
      $args['birth_date'],
      $args['gender'],
      $args['doc_type'],
      $args['dni'],
      $args['address'],
      $args['phone'],
      $args['id_medical_insurance'],
      $args['id']
    );
  }

  public function showView($args)
  {
    if ($this->canUpdate($args))
      $this->getView()->show();
  }
}

class PacientListController extends PacientsController
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getAll());
  }
}

class PacientEditController extends PacientsController
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getPacient($args['id']));
  }
}
