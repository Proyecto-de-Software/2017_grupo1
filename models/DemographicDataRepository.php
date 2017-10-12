<?php
class DemographicDataRepository extends PDORepository
{
  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;

  private function queryToDataArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new Demographic_data(
        $element['id_pacient'],
        $element['has_electricity'],
        $element['has_pet'],
        $element['has_refrigerator'],
        $element['heating_type'],
        $element['home_type'],
        $element['water_type']
      );
    }
    return $answer;
  }

  public function __construct()
  {
    $this->stmtDelete = $this->newPreparedStmt("DELETE FROM demographic_data WHERE id_pacient = ?");
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO demographic_data (id_pacient, has_electricity, has_pet, has_refrigerator, heating_type, home_type, water_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
   
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE demographic_data SET has_electricity = ?, has_pet = ?, has_refrigerator = ?, heating_type = ?, home_type = ?, water_type WHERE id_pacient = ?");
  }


  public function create($id_pacient, $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type)
  {
    return $this->stmtCreate->execute([$id_pacient, $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type]);
  }

  public function delete($id_pacient)
  {
    return $this->stmtDelete->execute([$id_pacient]);
  }

  public function update($id_pacient, $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type)
  {
    return $this->stmtUpdate->execute([$id_pacient, $has_electricity, $has_pet, $has_refrigerator, $heating_type, $home_type, $water_type]);
  }

  public function getDemographicData($id_pacient)
  {
    return $this->queryToDataArray($this->queryList("SELECT * FROM demographic_data WHERE id_pacient = ?", [$id_pacient]))[0];
  }
}