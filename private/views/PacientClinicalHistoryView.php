<?php
class PacientClinicalHistoryView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacient_clinical_history.html";
  }

  public function show($pacient)
  {
    $this->render(array(
      'pacient' => $pacient));
  }
}
