<?php
class PacientDemographicDataView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacient_demographic_data.html";
  }

  public function show($demographic_data)
  {
    $this->render(array('data' => $demographic_data));
  }
}