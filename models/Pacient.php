<?php
class Pacient
{
  private $id;
  private $first_name;
  private $last_name;
  private $birth_date;
  private $gender;
  private $doc_type;
  private $address;
  private $phone;
  private $id_medical_insurance;
  private $has_refrigerator;
  private $has_electricity;
  private $hast_pet;
  private $home_type;
  private $heating_type;
  private $water_type;

  public function __construct(
    $id,
    $first_name,
    $last_name,
    $birth_date,
    $gender,
    $doc_type,
    $address,
    $phone,
    $id_medical_insurance,
    $has_refrigerator,
    $has_electricity,
    $hast_pet,
    $home_type,
    $heating_type,
    $water_type
  )
  {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->birth_date = $birth_date;
    $this->gender = $gender;
    $this->doc_type = $doc_type;
    $this->address = $address;
    $this->phone = $phone;
    $this->id_medical_insurance = $id_medical_insurance;
    $this->has_refrigerator = $has_refrigerator;
    $this->has_electricity = $has_electricity;
    $this->hast_pet = $hast_pet;
    $this->home_type = $home_type;
    $this->heating_type = $heating_type;
    $this->water_type = $water_type;
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

  public function getHas_Refrigerator()
  {
    return $this->has_refrigerator;
  }

  public function getHas_Electricity()
  {
    return $this->has_electricity;
  }

  public function getHas_Pet()
  {
    return $this->hast_pet;
  }

  public function getHome_Type()
  {
    return $this->home_type;
  }

  public function getHeating_Type()
  {
    return $this->heating_type;
  }

  public function getWater_Type()
  {
    return $this->water_type;
  }

}