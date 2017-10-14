<?php
class AdminController extends Controller
{
  private $view;
  private $repository;

  public function __construct($adminView)
  {
    $this->view = $adminView;
  }

  public function showView($args)
  {
    $this->view->show();
  }

protected function getView()
  {
    return $this->view;
  }

  protected function getRepository()
  {
    return $this->repository;
  }
}
class AdminUpdateController extends AdminController
{
  public function showView($args)
  {
    if ($this->getRepository()->update($args['title'], $args['description'], $args['contact_mail'], $args['page_row_size'],$args['avaiable']))
      $this->getView()->show();
  }
}

  
