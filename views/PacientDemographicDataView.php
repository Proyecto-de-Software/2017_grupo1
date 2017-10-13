<?php
class PacientDemographicDataView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacient_demographic_data.html";
  }

  public function show($pacient)
  {
    $this->render(array('pacient' => $pacient));
  }
}