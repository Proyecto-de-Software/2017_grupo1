<?php
class ClinicalHistoryRepository extends PDORepository
{
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
        $element['last_name'] . ',' . $element['first_name'],
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
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT * FROM clinical_history"));
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
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT U.last_name, U.first_name, H.*, P.birth_date
      FROM clinical_history H
      INNER JOIN pacients P ON (H.id_paciente = P.id)
      INNER JOIN users U ON (U.id = H.usuario)
      WHERE H.id_paciente = ?
      ORDER BY H.fecha", [$pacientId]));
  }

  public function getClinicalHistoryChartData($pacientId, $week_count)
  {
    /* PDO no me permite pasar el valor del LIMIT por parametro, por eso interpolo el string */
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT U.last_name, U.first_name, H.*, P.birth_date
      FROM clinical_history H
      INNER JOIN pacients P ON (H.id_paciente = P.id)
      INNER JOIN users U ON (U.id = H.usuario)
      WHERE H.id_paciente = ? AND
      H.fecha <= NOW()
      ORDER BY H.fecha
      LIMIT $week_count", [$pacientId]));
  }

  public function getClinicalHistory($historyId)
  {
    return $this->queryToClinicalHistoryArray($this->queryList("SELECT U.last_name, U.first_name, H.*, P.birth_date
      FROM clinical_history H
      INNER JOIN pacients P ON (H.id_paciente = P.id)
      INNER JOIN users U ON (U.id = H.usuario)
      WHERE H.id = ?
      ORDER BY H.fecha", [$historyId]))[0];
  }
}