<?php
class PacientsListView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacients_index.html";
  }

  public function show($pacients)
  {
    $this->render(array('pacients' => $pacients));
  }
}
