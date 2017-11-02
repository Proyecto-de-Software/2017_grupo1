<?php
class PacientClinicalHistoryView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacient_clinical_history.html";
  }

  public function show()
  {
    $this->render();
  }
}
