<?php
class PacientNewView extends TwigView
{
  protected function getTemplateFile()
  {
    return "paciente_new.html";
  }

  public function show()
  {
    $this->render();
  }
}