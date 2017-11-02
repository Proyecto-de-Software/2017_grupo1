<?php
class PacientClinicalHistoryController extends Controller
{
  protected function doShowView($args)
  {
    (new PacientClinicalHistoryView())->show();
  }
}