<?php
class PacientsBySocialInsuranceReport extends DemographicDataReport
{
  protected function getTitle()
  {
    return 'Pacientes por Obra Social';
  }

  protected function pullData()
  {
    return $this->pacientsRepository->getPatientsByMedicalInsurance();
  }
}