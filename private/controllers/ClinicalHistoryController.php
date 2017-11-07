<?php
abstract class ClinicalHistoryController extends Controller
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

class ClinicalHistoryNewController extends ClinicalHistoryController
{
}

abstract class ClinicalHistoryCRUDController extends ClinicalHistoryController
{
  private $repository;

  public function __construct($view, $repository){
    parent::__construct($view);
    $this->repository = $repository;
    }

  protected function getRepository(){
    return $this->repository;
    }

  protected function checkArgs($args)
  {
    if (!isset($args['fecha'])){
      echo('fecha');
      return false;}

    if (!isset($args['edad'])){
      echo('edad');
      return false;}

    if (!isset($args['peso'])){
      echo('peso');
      return false;}

    if (!isset($args['vacunas_completas'])){
      echo('vacunas_completas');
      return false;}

    if (!isset($args['vacunas_obs'])){
      echo('vacunas_obs');
      return false;}

    if (!isset($args['maduracion_acorde'])){
      echo('maduracion_acorde');
      return false;}

    if (!isset($args['maduracion_obs'])){
      echo('maduracion_acorde');
      return false;}

    if (!isset($args['examen_fisico'])){
      echo('examen_fisico');
      return false;}

    if (!isset($args['examenFisico_obs'])){
      echo('examenFisico_obs');
      return false;}

    if (!isset($args['percentilo_cefalico'])){
      echo('percentilo_cefalico');
      return false;}

    if (!isset($args['percentilo_perim_cefalico'])){
      echo('percentilo_perim_cefalico');
      return false;}

    if (!isset($args['talla'])){
      echo('talla');
      return false;}

    if (!isset($args['alimentacion'])){
      echo('alimentacion');
      return false;}

    if (!isset($args['obs_generales'])){
      echo('obs_generales');
      return false;}

    if (!isset($args['usuario'])){
      echo('usuario');
      return false;}

    if(!isset($args['id_paciente'])){
      echo('id_paciente');
      return false;}

    if (empty($args['fecha'])){
      echo('fecha');
      return false;}

    if (empty($args['edad'])){
      echo('edad');
      return false;}

    if (empty($args['peso'])){
      echo('peso');
      return false;}

    if (empty($args['vacunas_completas'])){
      echo('vacunas_completas');
      return false;}

    if (empty($args['vacunas_obs'])){
      echo('vacunas_obs');
      return false;}

    if (empty($args['maduracion_acorde'])){
      echo('maduracion_acorde');
      return false;}

    if (empty($args['maduracion_obs'])){
      echo('maduracion_obs');
      return false;}

    if (empty($args['examen_fisico'])){
      echo('examen_fisico');
      return false;}

    if (empty($args['examenFisico_obs'])){
      echo('examenFisico_obs');
      return false;}

    if (empty($args['percentilo_cefalico'])){
      echo('percentilo_cefalico');
      return false;}

    if (empty($args['percentilo_perim_cefalico'])){
      echo('percentilo_perim_cefalico');
      return false;}

    if (empty($args['talla'])){
      echo('talla');
      return false;}

    if (empty($args['alimentacion'])){
      echo('alimentacion');
      return false;}

    if (empty($args['obs_generales'])){
      echo('obs_generales');
      return false;}

    if (empty($args['usuario'])){
      echo('usuario');
      return false;}

    if (empty($args['id_paciente'])){
      echo('id_paciente');
      return false;}

    return true;
  }
}


/************************************************************************/
class ClinicalHistoryAddedController extends ClinicalHistoryCRUDController
{
  private function canCreate($args)
  {
    return $this->getRepository()->create(
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
      $args['usuario'],
      $args['id_paciente']
    );
  }


  protected function doShowView($args){
    if ($this->canCreate($args))
      return $this->getView()->show();
  }
}

class ClinicalHistoryUpdatedController extends ClinicalHistoryCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id_paciente']))
      return false;

    if (!is_numeric($args['id_paciente']))
      return false;

    return parent::checkArgs($args);
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
      $args['usuario'],
      $args['id_paciente']
    );
  }

  protected function doShowView($args){
     if ($this->canUpdate($args))
      return $this->getView()->show();
  }
}

class ClinicalHistoryListController extends ClinicalHistoryCRUDController
{
  protected function checkArgs($args){
    return true;

  }

  protected function doShowView($args)
  {
    echo("controller");
    print_r($_SESSION);
    $this->getView()->show($this->getRepository()->getClinicalHistory($args['id_paciente']));
  }

}

class ClinicalHistoryEditController extends ClinicalHistoryCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id_paciente']))
      return false;

    if (!is_numeric($args['id_paciente']))
      return false;

    return true;
  }

  protected function doShowView($args)
  { 
    $this->getView()->show($this->getRepository()->getClinicalHistory($args['id_paciente']));
  }
}

class ClinicalHistoryDestroyedController extends ClinicalHistoryCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id_paciente']))
      return false;

    if (!is_numeric($args['id_paciente']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    if ($this->getRepository()->delete($args['id_paciente']))
      $this->getView()->show();
  }
}