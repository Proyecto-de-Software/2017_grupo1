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

class ClinicalHistoryListView extends ClinicalHistoryView
{
  protected function getTemplateFile()
  {
    return "clinicalHistory_index.html";
  }

  public function show($clinicalHistory)
  {
    echo("view");
    print_r($_SESSION);
    die();
   $this->render(array('historial' => $clinicalHistory));
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
     $this->render(array('clinicalHistory' => $clinicalHistory));
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
