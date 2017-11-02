<?php
class ClinicalHistoryRepository extends PDORepository {

  private $stmtCreate;
  private $stmtUpdate;

  public function __construct()
    {
      $this->stmtCreate = $this->newPreparedStmt("INSERT INTO clinical_history (fecha, edad, peso, vacunas_completas, vacunas_obs, maduracion_acorde, maduracion_obs, examen_fisico, examenFisico_obs, percentilo_cefalico, percentilo_perim_cefalico, talla, alimentacion, obs_generales, usuario)
                                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      
      $this->stmtUpdate = $this->newPreparedStmt("UPDATE clinical_history SET fecha = ?, peso = ?, vacunas_completas = ?, vacunas_obs = ?, maduracion_acorde = ?, maduracion_obs = ?, examen_fisico = ?, examenFisico_obs = ?, percentilo_cefalico = ?, percentilo_perim_cefalico = ?, talla = ?, alimentacion = ?, obs_generales = ?, usuario = ? WHERE id = ?");
    }


  public function create($fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario)
    {
      return $this->stmtCreate->execute([$fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario]);
    }


  public function update($fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario)
    {
      return $this->stmtUpdate->execute([$fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario]);
    }


}