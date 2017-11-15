<?php
class PacientsByHeatingTypeReport extends DemographicDataReport
{
  protected function getTitle()
  {
    return 'Pacientes por Tipo de Calefaccion';
  }

  protected function pullData()
  {
    return $this->pacientsRepository->getPatientsByHeatingType();
  }
}