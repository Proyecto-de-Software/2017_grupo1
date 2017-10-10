<?php
class PacientsFormView extends TwigView{
  
  protected function getTemplateFile(){
  	return "pacient_form_update.html";
  }
   public function show($pacients)
  {
    $this->render(array('pacients' => $pacients));
  }

}