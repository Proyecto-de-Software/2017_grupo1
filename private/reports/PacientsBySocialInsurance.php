<?php
class PacientsBySocialInsurance extends DemographicDataReport
{
  protected function getTitle()
  {
    return 'Pacientes por Obra Social';
  }

  protected function pullData()
  {
    return $this->pacientsRepository->getPatientsBySocialInsurance();
  }
}