<?php
class UserFormView extends TwigView{
  
  protected function getTemplateFile(){
  	return "user_form_update.html";
  }
   public function show($user)
  {
    $this->render(array('user' => $user));
  }

}