<?php
class ClinicalHistoryUpdatedView extends TwigView{
  
  protected function getTemplateFile(){
    return "clinical_history_updated.html";
  }
   public function show()
  {
    $this->render();
  }

}