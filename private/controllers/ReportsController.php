<?php
class ReportsController extends Controller
{
  private $reports;

  public function __construct()
  {
    $this->reports = [];
  }

  public function addReport($name, $report)
  {
    $this->reports[$name] = $report;
  }

  protected function doShowView($args)
  {
    if (isset($args['report']))
      $view = $this->getReportView($this->sanitize($args['report']));
    else
      $view = $this->getView();

    $view->show();
  }

  private function getReportNames()
  {
    return array_keys($this->reports);
  }

  private function getReportView($reportName)
  {
    if (!in_array($reportName, $this->getReportNames()))
      return $this->getView();

    return $this->reports[$reportName];
  }

  private function getView()
  {
    return new ReportsView($this->getReportNames());
  }
}