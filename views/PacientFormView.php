<?php
class PacientsFormView extends TwigView{
  
  protected function getTemplateFile(){
  	return "pacient_form_update.html";
  }
   public function show($pacient)
  {
    $this->render(array('pacient' => $pacient));
  }

}