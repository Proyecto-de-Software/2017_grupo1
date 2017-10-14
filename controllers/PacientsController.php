<?php
class PacientsController extends Controller
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
      $args['id_medical_insurance'],
      $args['has_electricity'],
      $args['has_pet'],
      $args['has_refrigerator'],
      $args['heating_type'],
      $args['home_type'],
      $args['water_type']
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
      $args['has_electricity'],
      $args['has_pet'],
      $args['has_refrigerator'],
      $args['heating_type'],
      $args['home_type'],
      $args['water_type'],
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
  private $appConfig;

  public function __construct($view, $repository,$appConfig)
  {
    parent::__construct($view, $repository);
    $this->appConfig= $appConfig;
  }

  public function showView($args)
  {
    if (!isset($args['page']))
      $page = 1;
    else
      $page = $args['page'];

    if (!isset($args['filter']))
    {
      $data_count = $this->getRepository()->getPacientCount();
      $data = $this->getRepository()->getAll($page);
    }
    else
    {
      $data_count = count($data);
      $data = $this->getRepository()->getAllByFilter($args['filter'], $page);
    }

    $this->getView()->show($data, $data_count / $this->appConfig->getPage_row_size());
  }
}

class PacientEditController extends PacientsController
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getPacient($args['id']));
  }
}

//baja
class PacientDestroyedController extends PacientsController
{
  public function showView($args)
  {
    if ($this->getRepository()->delete($args['id']))
      $this->getView()->show();
  }
}
