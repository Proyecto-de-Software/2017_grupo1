<?php
class PacientClinicalHistoryController extends Controller
{
  private $view;

  public function __construct($view)
  {
    $this->view = $view;
  }

  protected function doShowView($args)
  {
    $this->getView()->show($args);
  }

  protected function getView()
  {
    return $this->view;
  }

}

class ClinicalHistoryUpdatedController extends PacientClinicalHistoryController
{
  private $repository;

  public function __construct($repository)
  {
    $this->repository = $repository;
  }
  
  protected function getRepository()
  {
    return $this->repository;
  }

  private function canUpdate($args)
  {
    return $this->getRepository()->update(
      $args['fecha'],
      $args['edad'],
      $args['peso'],
      $args['vacunas_completas'],
      $args['vacunas_obs'],
      $args['maduracion_acorde'],
      $args['maduracion_obs'],
      $args['examen_fisico'],
      $args['examenFisico_obs'],
      $args['percentilo_cefalico'],
      $args['percentilo_perim_cefalico'],
      $args['talla'],
      $args['alimentacion'],
      $args['obs_generales'],
      $args['usuario']
    );
  }

  private function doUpdate($args) {
  
    if ($this->canUpdate($args))
      return $this->getView();
  }

  protected function doShowView($args)
  {
    $this->doUpdate($args)->show();
  }
}  