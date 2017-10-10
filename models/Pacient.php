<?php
class Pacient
{
  private $id;
  private $first_name;
  private $last_name;
  private $birth_date;
  private $gender;
  private $doc_type;
  private $dni;
  private $address;
  private $phone;
  private $id_medical_insurance;


  public function __construct(
    $id,
    $first_name,
    $last_name,
    $birth_date,
    $gender,
    $doc_type,
    $dni,
    $address,
    $phone,
    $id_medical_insurance
   )
  {
    $this->id = $id;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->birth_date = $birth_date;
    $this->gender = $gender;
    $this->doc_type = $doc_type;
    $this->dni = $dni;
    $this->address = $address;
    $this->phone = $phone;
    $this->id_medical_insurance = $id_medical_insurance;
  
  }

  public function getId()
  {
    return $this->id;
  }

  public function getFirst_Name()
  {
    return $this->first_name;
  }

  public function getLast_Name()
  {
    return $this->last_name;
  }

  public function getBirth_Date()
  {
    return $this->birth_date;
  }

  public function getGender()
  {
    return $this->gender;
  }

  public function getDoc_Type()
  {
    return $this->doc_type;
  }
  public function getDNI()
  {
    return $this->dni;
  }
  public function getAddress()
  {
    return $this->address;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function getId_Medical_Insurance()
  {
    return $this->id_medical_insurance;
  }

}