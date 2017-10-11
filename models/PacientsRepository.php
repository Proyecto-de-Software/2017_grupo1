<?php
class PacientsRepository extends PDORepository
{
  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;

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
        $element['id_medical_insurance']
      );
    }
    return $answer;
  }

  public function __construct()
  {
    $this->stmtDelete = $this->newPreparedStmt("DELETE FROM pacients WHERE id = ?");
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO pacients (first_name, last_name, birth_date, gender, doc_type,
                                                dni, address, phone, id_medical_insurance)
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE pacients SET first_name = ?, last_name = ?, birth_date = ?, gender = ?, doc_type = ?,
                                                dni = ?, address = ?, phone = ?, id_medical_insurance = ?  WHERE id = ?");
  }

  public function getAll()
  {
    return $this->queryToPacientArray($this->queryList("SELECT * FROM pacients", []));
  }

  public function create($first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance)
  {
    return $this->stmtCreate->execute([$first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance]);
  }

  public function delete($pacientId)
  {
    return $this->stmtDelete->execute([$pacientId]);
  }

  public function update($first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance, $pacientId)
  {
    return $this->stmtUpdate->execute([$first_name, $last_name, $birth_date, $gender, $doc_type, $dni, $address, $phone, $id_medical_insurance, $pacientId]);
  }

  public function getPacient($pacientId)
  {
    return $this->queryToPacientArray($this->queryList("SELECT * FROM pacients WHERE id = ?", [$pacientId]))[0];
  }
}



