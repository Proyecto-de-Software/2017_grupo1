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
    return "clinical_history_form_new.html";
  }

  public function show($id_paciente)
  {
   $this->render(array('id_paciente' => $id_paciente));
  }
}

class ClinicalHistoryListView extends ClinicalHistoryView
{
  protected function getTemplateFile()
  {
    return "clinical_history_index.html";
  }

  public function show($id_paciente, $clinicalHistory)
  {
   $this->render(array('historial' => $clinicalHistory,
                      'id_paciente' => $id_paciente));
  }
}

class ClinicalHistoryAddedView extends ClinicalHistoryView {

  protected function getTemplateFile()
  {
    return "clinical_history_added.html";
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
    return "clinical_history_form_update.html";
  }

  public function show($clinicalHistory)
  {
     $this->render(array('clinicalHistory' => $clinicalHistory));
  }
}

class ClinicalHistoryUpdatedView extends ClinicalHistoryView {
  
  protected function getTemplateFile(){
    return "clinical_history_updated.html";
  }
   public function show()
  {
    $this->render();
  }

}

class ClinicalHistoryDestroyedView extends ClinicalHistoryView {
  
  protected function getTemplateFile(){
    return "clinical_history_destroyed.html";
  }
   public function show()
  {
    $this->render();
  }

}
