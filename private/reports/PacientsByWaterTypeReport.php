<?php
class PacientsByWaterTypeReport extends DemographicDataReport
{
  protected function getTitle()
  {
    return 'Pacientes por Tipo de Agua';
  }

  protected function pullData()
  {
    return $this->pacientsRepository->getPatientsByWaterType();
  }
}