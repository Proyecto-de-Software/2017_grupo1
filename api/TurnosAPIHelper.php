<?php
class TurnosAPIException extends Exception
{
  const INVALID_DATE_FORMAT = 1;
  const INVALID_DATE_RANGE = 2;
  const INVALID_TIME_FORMAT = 3;
  const INVALID_TIME_RANGE = 4;
  const INVALID_APPOINTMENT_TIME = 5;
  const INVALID_DNI = 6;
  const DNI_NOT_EXISTS = 7;
  const ALREADY_APPOINTED = 8;

  public function __construct($message, $code)
  {
    parent::__construct($message, $code);
  }
}

class TurnosAPIHelper
{
  private static function getPatientsRepository()
  {
      return new \PacientsRepository(new \AppConfig);
  }

  private static function isBetween($value, $min, $max)
  {
    return ($value >= $min && $value <= $max);
  }

  public static function isValidDate($date)
  {
    $d = \DateTime::createFromFormat('d-m-Y', $date);
    if (!($d && $d->format('d-m-Y') == $date))
      throw new \TurnosAPIException("$date no es una fecha valida, usar formato dd-mm-aaaa. Ejemplo <25-10-2017>", TurnosAPIException::INVALID_DATE_FORMAT);
  }

  public static function isValidTime($time_str)
  {
    if (!preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $time_str))
      throw new \TurnosAPIException("$time_str es una hora invalida", TurnosAPIException::INVALID_TIME_FORMAT);

    $time = \DateTime::createFromFormat('H:i', $time_str);
    if (!$time)
      throw new \TurnosAPIException("$time_str es una hora invalida", TurnosAPIException::INVALID_TIME_FORMAT);

    $date_time = date_parse($time->format('H:i'));
    $hour = $date_time['hour'];
    $minute = $date_time['minute'];

    if (!self::isBetween($hour, 8, 20))
      throw new \TurnosAPIException('La hora debe ser entre 8:00 y 20:00', TurnosAPIException::INVALID_TIME_RANGE);

    if ($minute != 30 && $minute != 0)
      throw new \TurnosAPIException('Horario de turno invalido, debe ser cada 30 minutos', TurnosAPIException::INVALID_APPOINTMENT_TIME);
  }

  public static function isValidDni($dni)
  {
    if (!isset($dni) || empty($dni))
      throw new \TurnosAPIException('El DNI no es valido', TurnosAPIException::INVALID_DNI);

    if (!self::getPatientsRepository()->dniExists($dni))
      throw new \TurnosAPIException("El DNI $dni no existe en el sistema", TurnosAPIException::DNI_NOT_EXISTS);
  }

  public static function getAppointmentsRepository()
  {
    return new \AppointmentsRepository;
  }
}