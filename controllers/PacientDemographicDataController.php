<?php
class PacientDemographicDataController
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

class DemographicDataAddedController extends PacientDemographicDataController
{
  private function canCreate($args)
  {
    return $this->getRepository()->create(
      $args['id_pacient'],
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

class DemographicDataUpdatedController extends PacientDemographicDataController
{
  private function canUpdate($args)
  {
    return $this->getRepository()->update(
      $args['id_pacient'],
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
    if ($this->canUpdate($args))
      $this->getView()->show();
  }
}


class DemographicDataListController extends PacientDemographicDataController
{
  public function showView($args)
  {
    var_dump($args);
    $this->getView()->show($this->getRepository()->getDemographicData($args['id']));
  }
}

//baja
class DemographicDataDestroyedController extends PacientDemographicDataController
{
  public function showView($args)
  {
    if ($this->getRepository()->delete($args['id_pacient']))
      $this->getView()->show();
  }
}
