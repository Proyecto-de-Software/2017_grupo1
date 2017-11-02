<?php
class ClinicalHistory
{
  private $id;
  private $fecha;
  private $edad;
  private $peso;
  private $vacunas_completas;
  private $vacunas_obs;
  private $maduracion_acorde;
  private $maduracion_obs;
  private $examen_fisico;
  private $examenFisico_obs;
  private $percentilo_cefalico;
  private $percentilo_perim_cefalico;
  private $talla;
  private $alimentacion;
  private $obs_generales;
  private $usuario;
  private $id_paciente;

  public function __construct(
    $id,
    $fecha,
    $edad,
    $peso,
    $vacunas_completas,
    $vacunas_obs,
    $maduracion_acorde,
    $maduracion_obs,
    $examen_fisico,
    $examenFisico_obs,
    $percentilo_cefalico,
    $percentilo_perim_cefalico,
    $talla,
    $alimentacion,
    $obs_generales,
    $usuario,
    $id_paciente
   )
  {
    $this->id = $id;
    $this->fecha = $fecha;
    $this->edad = $edad;
    $this->peso = $peso;
    $this->vacunas_completas = $vacunas_completas;
    $this->vacunas_obs = $vacunas_obs;
    $this->maduracion_acorde = $maduracion_acorde;
    $this->maduracion_obs = $maduracion_obs;
    $this->examen_fisico = $examen_fisico;
    $this->examenFisico_obs = $examenFisico_obs;
    $this->percentilo_cefalico = $percentilo_cefalico;
    $this->percentilo_perim_cefalico = $percentilo_perim_cefalico;
    $this->talla = $talla;
    $this->alimentacion = $alimentacion;
    $this->obs_generales = $obs_generales;
    $this->usuario = $usuario;
    $this->id_paciente = $id_paciente;
  }

  public function getFull_Name()
  {
    return $this->getPacient($id_paciente)->getFull_Name();
  }

  public function getId()
  {
    return $this->id;
  }

  public function getFecha()
  {
    return $this->fecha;
  }

  public function getEdad()
  {
    return $this->edad;
  }

  public function getPeso()
  {
    return $this->peso;
  }

  public function getVacunas_completas()
  {
    return $this->vacunas_completas;
  }

  public function getVacunas_obs()
  {
    return $this->vacunas_obs;
  }
  public function getMaduracion_acorde()
  {
    return $this->maduracion_acorde;
  }
  public function getMaduracion_obs()
  {
    return $this->maduracion_obs;
  }

  public function getExamen_fisico()
  {
    return $this->examen_fisico;
  }

  public function getExamenFisico_obs()
  {
    return $this->examenFisico_obs;
  }
  public function getPercentilo_cefalico()
  {
    return $this->percentilo_cefalico;
  }

  public function getPercentilo_perim_cefalico()
  {
    return $this->percentilo_perim_cefalico;
  }

  public function getTalla()
  {
    return $this->talla;
  }

  public function getAlimentacion()
  {
    return $this->alimentacion;
  }

  public function getObs_generales()
  {
    return $this->obs_generales;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  public function getId_paciente()
  {
    return $this->id_paciente;
  }

}


