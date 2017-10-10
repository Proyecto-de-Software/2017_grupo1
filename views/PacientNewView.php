<?php
class PacientNewView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacient_new.html";
  }

  public function show()
  {
    $this->render();
  }
}