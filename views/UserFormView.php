<?php
class EditUserView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_form_update.html";
  }

  public function show($user)
  {
    $this->render(array('user' => $user));
  }
}

class NewUserView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_form_new.html";
  }

  public function show()
  {
    $this->render();
  }
}