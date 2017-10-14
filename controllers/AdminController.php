<?php
class AdminController extends Controller
{
  private $view;

  public function __construct($adminView)
  {
    $this->view = $adminView;
  }

  public function showView($args)
  {
    $this->view->show();
  }
}

class AdminUpdateController extends Controller
{
  private $view;
  private $appConfig;

  public function __construct($adminView, $appConfig)
  {
    $this->view = $adminView;
    $this->appConfig = $appConfig;
  }

  public function showView($args)
  {
    if ($this->appConfig->update($args['title'], $args['description'], $args['contact_mail'], $args['page_row_size'], ($args['avaiable'] == "Si")))
      $this->view->show();
  }
}


