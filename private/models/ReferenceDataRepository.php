<?php
abstract class ReferenceDataRepository
{
  public abstract function getAll();
  public abstract function getById($id);
}

class APIReferenceDataRepository extends ReferenceDataRepository
{
  private static $default_BaseAPIUrl =  "https://api-referencias.proyecto2017.linti.unlp.edu.ar/";
  private $baseAPIUrl;
  private $resourceName;

  public function __construct($resourceName, $baseAPIUrl = '')
  {
    $this->resourceName = $resourceName;
    if (empty($baseAPIUrl))
      $this->baseAPIUrl = self::$default_BaseAPIUrl;
    else
      $this->baseAPIUrl = $baseAPIUrl;
  }

  public function getAll()
  {
    $answer = array();
    foreach ($this->fetch($this->getAPI()) as &$element) {
      $answer[] = $this->createElement($element->{'id'}, $element->{'nombre'});
    }

    return $answer;
  }

  public function getById($id)
  {
    $data = $this->fetch($this->getAPI() . "/$id");
    return  $this->createElement($data->{'id'}, $data->{'nombre'});
  }

  protected function createElement($id, $description)
  {
    return new ReferenceData($id, $description);
  }

  private function fetch($url)
  {
    return json_decode(file_get_contents($url));
  }

  private function getAPI()
  {
    return $this->baseAPIUrl . $this->resourceName;
  }
}