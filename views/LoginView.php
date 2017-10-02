<?php
class LoginView extends TwigView
{
  protected function getTemplateFile()
  {
    return "login.html";
  }

  public function show()
  {
    $this->render();
  }
}
