<?php
class PacientsBySocialInsurance extends DemographicDataReport
{
  protected function getTitle()
  {
    return 'Pacientes por Obra Social';
  }

  protected function pullData()
  {
    $answer = [];
    $data = $this->pacientsRepository->getPatientsBySocialInsurance();
    foreach ($data as &$element) {
      $answer[] = [
          'name' => $this->demographicDataRepository->getById($element['group_id'])->getDescription(),
          'y' => intval($element['group_count'])
      ];
    };
    return $answer;
  }
}