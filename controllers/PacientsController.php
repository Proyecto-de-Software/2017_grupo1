<?php
class PacientsController {
  private $view;
  private $repository;

  public function __construct($view, $repository) {
    $this->repository = $repository;
    $this->view = $view;
  }

   public function showView($args)
  {
    $this->getView()->show($args);
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

class PacientAddedController extends PacientsController 
{
  public function showView($args) 
  {
    if ($this->getRepository()->create($args['first_name'], $args['last_name'], $args['birth_date'], $args['gender'], $args['doc_type'], $args['dni'], $args['address'], $args['phone'], $args['id_medical_insurance'])) 
    
    $this->getView()->show(); 

  }
}

class PacientUpdatedController extends PacientsController 
{
  public function showView($args) 
  {
    
    if ($this->getRepository()->update($args['first_name'], $args['last_name'], $args['birth_date'], $args['gender'], $args['doc_type'], $args['dni'], $args['address'], $args['phone'], $args['id_medical_insurance'], $args['id']))
    $this->getView()->show(); 

  }
}

class PacientListController extends PacientsController
{
  public function showView($args)
  {
   $this->getView()->show($this->getRepository()->getAll());
  }
}

class PacientFormController extends PacientsController //modificacion 
{
  public function showView($args)
  {
    $this->getView()->show($this->getRepository()->getPacient($args['id']));
  } 

}

