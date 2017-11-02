<?php
abstract class ClinicalHistoryView extends TwigView{

  protected function doShow($args = []){
    $this->render($args);
  }

}

class NewClinicalHistoryView extends ClinicalHistoryView
{
  protected function getTemplateFile()
  {
    return "clinicalHistory_form_new.html";
  }

  public function show($clinicalHistory)
  {
    $this->doShow([]);
  }
}

class ClinicalHistoryAddedView extends ClinicalHistoryView {

  protected function getTemplateFile()
  {
    return "clinicalHistory_added.html";
  }

  public function show()
  {
    $this->render();
  }
}

class EditClinicalHistoryView extends ClinicalHistoryView
{
  protected function getTemplateFile()
  {
    return "clinicalHistory_form_update.html";
  }

  public function show($clinicalHistory)
  {
    var_dump($clinicalHistory);
    $this->doShow(array('clinicalHistory' => $clinicalHistory));
  }
}

class ClinicalHistoryUpdatedView extends ClinicalHistoryView {
  
  protected function getTemplateFile(){
    return "clinicalHistory_updated.html";
  }
   public function show()
  {
    $this->render();
  }

}

class ClinicalHistoryDestroyedView extends ClinicalHistoryView {
  
  protected function getTemplateFile(){
    return "clinicalHistory_destroyed.html";
  }
   public function show()
  {
    $this->render();
  }

}
