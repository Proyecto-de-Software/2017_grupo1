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
  public function getUpdateFile(){
  	return "paciente_update.html";
  }
}
