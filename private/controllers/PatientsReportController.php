<?php
abstract class PatientsReportController extends Controller
{
  private $clinicalHistoryRepository;
  private $patientsRepository;

  public function __construct($clinicalHistoryRepository, $patientsRepository)
  {
    $this->clinicalHistoryRepository = $clinicalHistoryRepository;
    $this->patientsRepository = $patientsRepository;
  }

  protected function checkArgs($args)
  {
    if (!isset($args['id_paciente']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    $id_paciente = $this->sanitize($args['id_paciente']);
    $paciente = $this->getPatientsRepository()->getPacient($id_paciente);
    if ($paciente->getGender() == 'M')
      $this->getBoysReport()->show($id_paciente);
    else
      $this->getGirlsReport()->show($id_paciente);
  }

  abstract protected function getBoysReport();
  abstract protected function getGirlsReport();

  protected function getClinicalHistoryRepository()
  {
    return $this->clinicalHistoryRepository;
  }

  protected function getPatientsRepository()
  {
    return $this->patientsRepository;
  }
}

class GrowthReportController extends PatientsReportController
{
  protected function getBoysReport()
  {
    return new BoysWeightGrowthReport($this->getClinicalHistoryRepository());
  }

  protected function getGirlsReport()
  {
    return new GirlsWeightGrowthReport($this->getClinicalHistoryRepository());
  }
}

class TallReportController extends PatientsReportController
{
  protected function getBoysReport()
  {
    return new BoysTallGrowthReport($this->getClinicalHistoryRepository());
  }

  protected function getGirlsReport()
  {
    return new GirlsTallGrowthReport($this->getClinicalHistoryRepository());
  }
}

class PPCReportController extends PatientsReportController
{
  protected function getBoysReport()
  {
    return new BoysPPCGrowthReport($this->getClinicalHistoryRepository());
  }

  protected function getGirlsReport()
  {
    return new BoysPPCGrowthReport($this->getClinicalHistoryRepository());
  }
}