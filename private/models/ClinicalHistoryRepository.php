<?php
class ClinicalHistoryRepository extends PDORepository {

  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;

  private function queryToClinicalHistoryArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new ClinicalHistory(
        $element['id'],
        $element['fecha'],
        $element['edad'],
        $element['peso'],
        $element['vacunas_completas'],
        $element['vacunas_obs'],
        $element['maduracion_acorde'],
        $element['maduracion_obs'],
        $element['examen_fisico'],
        $element['examenFisico_obs'],
        $element['percentilo_cefalico'],
        $element['percentilo_perim_cefalico'],
        $element['talla'],
        $element['alimentacion'],
        $element['obs_generales'],
        $element['usuario'],
        $element['id_paciente']
      );
    }
    return $answer;
  }

  public function __construct()
    {
      $this->stmtCreate = $this->newPreparedStmt("INSERT INTO clinical_history (fecha, edad, peso, vacunas_completas, vacunas_obs, maduracion_acorde, maduracion_obs, examen_fisico, examenFisico_obs, percentilo_cefalico, percentilo_perim_cefalico, talla, alimentacion, obs_generales, usuario, id_paciente)
                                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      
      $this->stmtUpdate = $this->newPreparedStmt("UPDATE clinical_history SET fecha = ?, edad = ?, peso = ?, vacunas_completas = ?, vacunas_obs = '?', maduracion_acorde = ?, maduracion_obs = '?', examen_fisico = ?, examenFisico_obs = '?', percentilo_cefalico = ?, percentilo_perim_cefalico = ?, talla = ?, alimentacion = '?', obs_generales = '?', usuario = ? WHERE id_paciente = ?");
    }

  public function getAll()
  {
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT * FROM clinical_history"),[]);
  }

  public function create($fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id_paciente)
    {
      return $this->stmtCreate->execute([$fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id_paciente]);
    }


  public function update($fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id_paciente)
    {
      return $this->stmtUpdate->execute([$fecha, $edad, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id_paciente]);
    }


  public function getClinicalHistory($pacientId)
  { 
    return ($this->queryToClinicalHistoryArray($this->queryList("SELECT * FROM clinical_history WHERE id_paciente = ?", [$pacientId][0])));
  }
}