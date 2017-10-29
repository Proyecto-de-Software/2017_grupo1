<?php
class AppointmentsRepository extends PDORepository
{
  private $stmtCreate;
  private static $mysql_datetime_format = 'Y-m-d H:i:s';
  private static $date_only_format = 'd-m-Y';

  private function all_appointment_times()
  {
    $times = array();
    for ($i=8; $i <= 20; $i++) {
      $times[] = sprintf("%02d:00", $i);
      $times[] = sprintf("%02d:30", $i);
    }
    array_pop($times); // saco el horario 20:30
    return $times;
  }

  function mysql_datetime($datetime)
  {
    return $this->convertDate($datetime, self::$date_only_format, self::$mysql_datetime_format);
  }

  function only_date_from($datetime)
  {
    return $this->convertDate($datetime, self::$mysql_datetime_format, self::$date_only_format);
  }

  function convertDate($value, $format_from, $format_to)
  {
    return DateTime::createFromFormat($format_from, $value)->format($format_to);
  }

  function time_without_seconds($time)
  {
    return substr($time, 0, 5);
  }

  private function getPatientId($dni)
  {
    $stmt = $this->newPreparedStmt("SELECT id FROM pacients WHERE dni = ?");
    $stmt->execute([$dni]);
    return $stmt->fetchColumn();
  }

  private function queryToAppointmentArray($query)
  {
    $answer = array();
    foreach ($query as &$element) {
      $answer[] = new Appointment(
          $element['id'],
          $element['dni'],
          $this->only_date_from($element['fecha']),
          $this->time_without_seconds($element['hora']),
          $this->only_date_from($element['fecha_solicitud']));
    }
    return $answer;
  }

  public function checkAvaiable($date, $time)
  {
    $index = array_search($time, $this->getAvailableAppointments($date));
    return $index > 0;
  }

  public function __construct()
  {
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO appointments (id_patient, fecha, hora, fecha_solicitud) VALUES (?, ?, ?, NOW()) ");
  }

  public function getAppointments($date)
  {
    return $this->queryToAppointmentArray($this->queryList("SELECT A.*, P.dni FROM appointments A
                                                                                                   INNER JOIN pacients P ON A.id_patient = P.id
                                                                                                   WHERE DATE(fecha) = DATE(?)", [$this->mysql_datetime($date)]));
  }

  public function getAvailableAppointments($date)
  {
    $answer = $this->all_appointment_times();
    foreach ($this->getAppointments($date) as &$each) {
      unset($answer[array_search($each->hora, $answer)]);
    }

    return array_values($answer);
  }

  public function appoint($date, $time, $dni)
  {
    if (!$this->checkAvaiable($date, $time))
      return false;

    return $this->stmtCreate->execute([$this->getPatientId($dni), $this->mysql_datetime($date), $time]);
  }

  public function getLastId()
  {
    $qry = $this->newPreparedStmt("SELECT id FROM appointments ORDER BY id DESC LIMIT 1");
    $qry->execute();
    $id = $qry->fetchColumn();
    return $id;
  }
}