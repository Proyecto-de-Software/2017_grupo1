<?php
class UserNewView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_new.html";
  }

  public function show()
  {
    $this->render();
  }
}