<?php
class PacientsRepository extends PDORepository
{
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
        $element['doc_type'],
        $element['dni'],
        $element['address'],
        $element['phone'],
        $element['id_medical_insurance'],
        $element['has_refrigerator'],
        $element['has_electricity'],
        $element['has_pet'],
        $element['home_type'],
        $element['heating_type'],
        $element['water_type']);
    }

    return $answer;
  }

  public function getAll()
  {
    return $this->queryToPacientArray($this->queryList("select * from pacients", []));
  }
}
