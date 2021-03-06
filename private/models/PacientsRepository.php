<?php
class PacientsRepository extends PDORepository
{
  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;
  private $appConfig;
  private $referenceDataService;

  private function queryToPacientArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new Pacient(
        $element['id'],
        $element['first_name'],
        $element['last_name'],
        $element['birth_date'],
        $element['gender'],
        $this->referenceDataService->getDocumentTypeById($element['doc_type']),
        $element['dni'],
        $element['address'],
        $element['phone'],
        $this->referenceDataService->getSocialInsuranceById($element['id_medical_insurance']),
        $element['has_electricity'],
        $element['has_pet'],
        $element['has_refrigerator'],
        $this->referenceDataService->getHeatingTypeById($element['heating_type']),
        $this->referenceDataService->getHomeTypeById($element['home_type']),
        $this->referenceDataService->getWaterTypeById($element['water_type'])
      );
    }
    return $answer;
  }

  public function __construct($appConfig, $referenceDataService)
  {
    $this->stmtDelete = $this->newPreparedStmt("DELETE FROM pacients WHERE id = ?");
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO pacients (first_name, last_name, birth_date, gender, doc_type,
                                                dni, address, phone, id_medical_insurance, has_electricity, has_pet, has_refrigerator, heating_type, home_type, water_type)
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE pacients SET first_name = ?, last_name = ?, birth_date = ?, gender = ?, doc_type = ?,
                                                dni = ?, address = ?, phone = ?, id_medical_insurance = ?, has_electricity = ?, has_pet = ?, has_refrigerator = ?, heating_type = ?, home_type = ?, water_type = ? WHERE id = ?");
    $this->appConfig = $appConfig;
    $this->referenceDataService = $referenceDataService;
  }

   public function getAll($page)
  {
    $count = $this->appConfig->getPage_row_size();
    $offset = ($page - 1) * $count;
    return $this->queryToPacientArray($this->queryList("SELECT * FROM pacients LIMIT $count OFFSET $offset"));
  }

  public function create($first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance, $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type)
  {
    return $this->stmtCreate->execute([$first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance,  $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type]);
  }

  public function delete($pacientId)
  {
    return $this->stmtDelete->execute([$pacientId]);
  }

  public function update($first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance, $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type, $pacientId)
  {
    return $this->stmtUpdate->execute([$first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance, $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type, $pacientId]);
  }

  public function getPacient($pacientId)
  {
    return $this->queryToPacientArray($this->queryList("SELECT * FROM pacients WHERE id = ?", [$pacientId]))[0];
  }

  public function getPacientCount()
  {
    $stmt = $this->newPreparedStmt("SELECT COUNT(*) FROM pacients");
    $stmt->execute();
    return $stmt->fetchColumn();
  }

    public function getPageCount()
  {
    return round($this->getPacientCount() / $this->appConfig->getPage_row_size());
  }

  public function getAllByFilter($filter, $page)
  {
    $count = $this->appConfig->getPage_row_size();
    $offset = ($page - 1) * $count;
    return $this->queryToPacientArray($this->queryList(
        "SELECT * FROM pacients
        WHERE (first_name LIKE ? OR last_name LIKE ? OR dni LIKE ?)
        ORDER BY last_name, first_name ASC
        LIMIT $count OFFSET $offset", ['%'.$filter.'%','%'.$filter.'%','%'.$filter.'%']));
  }

  public function dniExists($dni)
  {
    return !empty($this->queryList("SELECT * FROM pacients where dni = ?", [$dni]));
  }

  private function groupPatientsBy($groupType)
  {
    /* si uso parametros de PDO no funciona la query, por eso interpolo el string
    Igual es un metodo privado que es utilizado por el modelo, no puede haber nunca SQL injection */
    $qry =$this->newPreparedStmt("SELECT COUNT(*) AS group_count, $groupType AS group_id FROM pacients GROUP BY $groupType");
    $qry->execute();
    return $qry->fetchAll();
  }

  public function getPatientsByMedicalInsurance()
  {
    return $this->groupPatientsBy('id_medical_insurance');
  }

  public function getPatientsByWaterType()
  {
    return $this->groupPatientsBy('water_type');
  }

  public function getPatientsByHeatingType()
  {
    return $this->groupPatientsBy('heating_type');
  }

  public function getPatientsByHomeType()
  {
    return $this->groupPatientsBy('home_type');
  }

  public function getPatientsByDocumentType()
  {
    return $this->groupPatientsBy('doc_type');
  }
}



