<?php
class UserListView extends TwigView
{
  protected function getTemplateFile()
  {
    return "users_index.html";
  }

  public function show($users)
  {
    $this->render(array('users' => $users));
  }
}
