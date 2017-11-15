<?php
class PacientsByDocumentTypeReport extends DemographicDataReport
{
  protected function getTitle()
  {
    return 'Pacientes por Tipo de Documento';
  }

  protected function pullData()
  {
    return $this->pacientsRepository->getPatientsByDocumentType();
  }
}