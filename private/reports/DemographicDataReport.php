<?php
abstract class DemographicDataReport
{
  protected $pacientsRepository;
  protected $demographicDataRepository;

  public function __construct($pacientsRepository, $demographicDataRepository)
  {
    $this->pacientsRepository = $pacientsRepository;
    $this->demographicDataRepository = $demographicDataRepository;
  }

  public function show()
  {
    $this->createReport()->show();
  }

  abstract protected function pullData();

  abstract protected function getTitle();

  protected function createReport()
  {
    return (new DemographicDataReportView($this->getTitle(), $this->getCategories(), $this->getData()));
  }

  protected function getCategories()
  {
    $mapper =  function ($element)
    {
      return $element->getDescription();
    };

    return array_map($mapper, $this->demographicDataRepository->getAll());
  }

  protected function getData()
  {
    $data = [];
    foreach ($this->pullData() as &$element) {
      $data[] = [
          'name' => $this->demographicDataRepository->getById($element['group_id'])->getDescription(),
          'y' => intval($element['group_count'])
      ];
    };
    return json_encode($data);
  }
}