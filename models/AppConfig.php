<?php
class AppConfig extends PDORepository
{
  private function queryValue($field)
  {
    $qry = $this->getConnection()->query("SELECT '$field' FROM app_settings");
  }

  public function isSiteEnabled()
  {
    return $this->queryValue("avaible");
  }

  public function title()
  {
    return $this->queryValue("title");
  }

  public function contact_mail()
  {
    return $this->queryValue("contact_mail");
  }

  public function page_row_size()
  {
    return $this->queryValue("page_row_size");
  }
}
