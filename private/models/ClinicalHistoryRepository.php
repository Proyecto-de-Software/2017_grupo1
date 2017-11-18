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
        $element['id_paciente'],
        $element['birth_date']
      );
    }
    return $answer;
  }

  public function __construct()
    {
      $this->stmtCreate = $this->newPreparedStmt("INSERT INTO clinical_history (fecha, peso, vacunas_completas, vacunas_obs, maduracion_acorde, maduracion_obs, examen_fisico, examenFisico_obs, percentilo_cefalico, percentilo_perim_cefalico, talla, alimentacion, obs_generales, usuario, id_paciente)
                                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      
      $this->stmtUpdate = $this->newPreparedStmt("UPDATE clinical_history SET fecha = ?, peso = ?, vacunas_completas = ?, vacunas_obs = ?, maduracion_acorde = ?, maduracion_obs = ?, examen_fisico = ?, examenFisico_obs = ?, percentilo_cefalico = ?, percentilo_perim_cefalico = ?, talla = ?, alimentacion = ?, obs_generales = ?, usuario = ? WHERE id = ?");
      $this->stmtDelete = $this->newPreparedStmt("DELETE FROM clinical_history WHERE id = ?");
    }

  public function getAll()
  {
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT * FROM clinical_history"),[]);
  }

  public function create($fecha, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id_paciente)
    {
      return $this->stmtCreate->execute([$fecha, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id_paciente]);
    }


  public function update($fecha, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id)
    {

      return $this->stmtUpdate->execute([$fecha, $peso, $vacunas_completas, $vacunas_obs, $maduracion_acorde, $maduracion_obs, $examen_fisico, $examenFisico_obs, $percentilo_cefalico, $percentilo_perim_cefalico, $talla, $alimentacion, $obs_generales, $usuario, $id]);
    }
  
    public function delete($historyId)
  {
    return $this->stmtDelete->execute([$historyId]);
  }


  public function getPacientClinicalHistory($pacientId)
  { 
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT H.*, P.birth_date 
      FROM clinical_history H
      INNER JOIN pacients P ON (H.id_paciente = P.id)
      WHERE H.id_paciente = ?", [$pacientId]));
  }

    public function getClinicalHistory($historyId)
  { 
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT H.*, P.birth_date
      FROM clinical_history H
      INNER JOIN pacients P ON (H.id_paciente = P.id)
      WHERE H.id = ?", [$historyId]))[0];
  }
}