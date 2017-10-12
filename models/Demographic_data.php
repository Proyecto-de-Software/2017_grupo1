<?php
class Demographic_data {
  private $id_pacient;
  private $has_electricity;
  private $has_pet;
  private $has_refrigerator;
  private $heating_type;
  private $home_type;
  private $water_type;


  public function __construct(
    $id_pacient,
    $has_electricity,
    $has_pet,
    $has_refrigerator,
    $heating_type,
    $home_type,
    $water_type
   )
  {
    $this->id_pacient = $id_pacient;
    $this->has_electricity = $has_electricity;
    $this->has_pet = $has_pet;
    $this->has_refrigerator = $has_refrigerator;
    $this->heating_type = $heating_type;
    $this->home_type = $home_type;
    $this->water_type = $water_type;
  
  }

  public function getId()
  {
    return $this->id_pacient;
  }

  public function getHas_Electricity()
  {
    return $this->has_electricity;
  }

  public function getHas_Pet()
  {
    return $this->has_pet;
  }

  public function getHas_Refrigerator()
  {
    return $this->has_refrigerator;
  }

  public function getHeating_Type()
  {
    return $this->heating_type;
  }

  public function getHome_Type()
  {
    return $this->home_type;
  }
   public function getWater_Type()
  {
    return $this->water_type;
  }
  
}
