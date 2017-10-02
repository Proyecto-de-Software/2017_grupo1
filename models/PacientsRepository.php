<?php
class PacientsRepository extends PDORepository
{
  private function queryToPacientArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new Pacient(
        $element['id'],
        $element['name']
      );
    }

    return $answer;
  }

  public function getAll()
  {
    return $this->queryToPacientArray($this->queryList("select * from pacients", []));
  }
}
