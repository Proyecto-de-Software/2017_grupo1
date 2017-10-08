<?php
class UserCreateView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_create.html";
  }

  public function show()
  {
    $this->render();
  }
}