<?php
class ReferenceData
{
  private $id;
  private $desciption;

  public function __construct($id, $desciption)
  {
    $this->id = $id;
    $this->desciption = $desciption;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getDescription()
  {
    return $this->desciption;
  }
}