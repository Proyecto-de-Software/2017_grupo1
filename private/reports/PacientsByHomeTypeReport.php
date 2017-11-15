<?php
class PacientsByHomeTypeReport extends DemographicDataReport
{
  protected function getTitle()
  {
    return 'Pacientes por Tipo de Vivienda';
  }

  protected function pullData()
  {
    return $this->pacientsRepository->getPatientsByHomeType();
  }
}