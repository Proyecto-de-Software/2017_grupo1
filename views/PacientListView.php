<?php
class PacientListView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacients_index.html";
  }

  public function show($pacients, $pageCount)
  {
    $this->render(array('pacients' => $pacients,
                        'pageCount' => $pageCount));
  }
}
