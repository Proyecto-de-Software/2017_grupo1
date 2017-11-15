<?php
class ReportsView extends TwigView
{
  private $reports;

  public function __construct($reports)
  {
    $this->reports = $reports;
  }

  public function show()
  {
    $this->render(['reports' => $this->reports]);
  }

  protected function getTemplateFile()
  {
    return 'reports_index.html';
  }
}
