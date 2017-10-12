<?php
class PacientDemographicDataView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacient_demographic_data.html";
  }

  public function show($pacient)
  {
    echo $pacient->getFull_Name();
    $this->render(array('pacient' => $pacient));
  }
}