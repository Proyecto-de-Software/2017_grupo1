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
    return true;
    if (!isset($args['fecha'])){
      var_dump('fecha');
      return false;}

    if (!isset($args['edad'])){
      var_dump('edad');
      return false;}

    if (!isset($args['peso'])){
      var_dump('peso');
      return false;}

    if (!isset($args['vacunas_completas'])){
      var_dump('vacunas_completas');
      return false;}

    if (!isset($args['vacunas_obs'])){
      var_dump('vacunas_obs');
      return false;}

    if (!isset($args['maduracion_acorde'])){
      var_dump('maduracion_acorde');
      return false;}

    if (!isset($args['maduracion_obs'])){
      var_dump('maduracion_acorde');
      return false;}

    if (!isset($args['examen_fisico'])){
      var_dump('examen_fisico');
      return false;}

    if (!isset($args['examenFisico_obs'])){
      var_dump('examenFisico_obs');
      return false;}

    if (!isset($args['percentilo_cefalico'])){
      var_dump('percentilo_cefalico');
      return false;}

    if (!isset($args['percentilo_perim_cefalico'])){
      var_dump('percentilo_perim_cefalico');
      return false;}

    if (!isset($args['talla'])){
      var_dump('talla');
      return false;}

    if (!isset($args['alimentacion'])){
      var_dump('alimentacion');
      return false;}

    if (!isset($args['obs_generales'])){
      var_dump('obs_generales');
      return false;}

    if (!isset($args['usuario'])){
      var_dump('usuario');
      return false;}

    if(!isset($args['id_paciente'])){
      var_dump('id_paciente');
      return false;}

    if (empty($args['fecha'])){
      var_dump('fecha');
      return false;}

    if (empty($args['edad'])){
      var_dump('edad');
      return false;}

    if (empty($args['peso'])){
      var_dump('peso');
      return false;}

    if (empty($args['vacunas_obs'])){
      var_dump('vacunas_obs');
      return false;}

    if (empty($args['maduracion_obs'])){
      var_dump('maduracion_obs');
      return false;}

    if (empty($args['examenFisico_obs'])){
      var_dump('examenFisico_obs');
      return false;}

    if (empty($args['percentilo_cefalico'])){
      var_dump('percentilo_cefalico');
      return false;}

    if (empty($args['percentilo_perim_cefalico'])){
      var_dump('percentilo_perim_cefalico');
      return false;}

    if (empty($args['talla'])){
      var_dump('talla');
      return false;}

    if (empty($args['alimentacion'])){
      var_dump('alimentacion');
      return false;}

    if (empty($args['obs_generales'])){
      var_dump('obs_generales');
      return false;}

    if (empty($args['usuario'])){
      var_dump('usuario');
      return false;}

    if (empty($args['id_paciente'])){
      var_dump('id_paciente');
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
      $this->sanitize($args['fecha']),
      $this->sanitize($args['edad']),
      $this->sanitize($args['peso']),
      $this->sanitize($args['vacunas_completas']),
      $this->sanitize($args['vacunas_obs']),
      $this->sanitize($args['maduracion_acorde']),
      $this->sanitize($args['maduracion_obs']),
      $this->sanitize($args['examen_fisico']),
      $this->sanitize($args['examenFisico_obs']),
      $this->sanitize($args['percentilo_cefalico']),
      $this->sanitize($args['percentilo_perim_cefalico']),
      $this->sanitize($args['talla']),
      $this->sanitize($args['alimentacion']),
      $this->sanitize($args['obs_generales']),
      $this->sanitize($args['usuario']),
      $this->sanitize($args['id_paciente'])
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
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return parent::checkArgs($args);
  }

  private function canUpdate($args)
  {

    return $this->getRepository()->update(
      $this->sanitize($args['fecha']),
      $this->sanitize($args['edad']),
      $this->sanitize($args['peso']),
      $this->sanitize($args['vacunas_completas']),
      $this->sanitize($args['vacunas_obs']),
      $this->sanitize($args['maduracion_acorde']),
      $this->sanitize($args['maduracion_obs']),
      $this->sanitize($args['examen_fisico']),
      $this->sanitize($args['examenFisico_obs']),
      $this->sanitize($args['percentilo_cefalico']),
      $this->sanitize($args['percentilo_perim_cefalico']),
      $this->sanitize($args['talla']),
      $this->sanitize($args['alimentacion']),
      $this->sanitize($args['obs_generales']),
      $this->sanitize($args['usuario']),
      $this->sanitize($args['id'])
    );
  }

  protected function doShowView($args){
     if ($this->canUpdate($args))
      return $this->getView()->show();
  }
}

class ClinicalHistoryListController extends ClinicalHistoryCRUDController
{

  protected function checkArgs($args)
  {
    return true;
  }
  protected function doShowView($args)
  {
    $this->getView()->show($this->getRepository()->getPacientClinicalHistory($args['id_paciente']));
  }

}

class ClinicalHistoryEditController extends ClinicalHistoryCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return true;
  }

  protected function doShowView($args)
  { print_r($args);
    $this->getView()->show($this->getRepository()->getClinicalHistory($args['id']));
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