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

  private static $descriptions = [
    self::INVALID_DATE_FORMAT => 'Formato de fecha inválido, usar dd-mm-aaaa. Ejemplo <25-10-2017>',
    self::INVALID_DATE_RANGE => 'La fecha no puede ser anterior al dia actual',
    self::INVALID_TIME_FORMAT => 'Formato de hora inválido, usar hh:mm. Ejemplo <08:00>',
    self::INVALID_TIME_RANGE => 'La hora debe estar entre 08:00 y 20:00',
    self::INVALID_APPOINTMENT_TIME => 'Horario de turno inválido, debe ser cada 30 min comenzando desde las 08:00 hasta las 20:00',
    self::INVALID_DNI => 'El DNI es inválido',
    self::DNI_NOT_EXISTS => 'El DNI no existe en el sistema',
    self::ALREADY_APPOINTED => 'El turno solicitado ya se encuentra ocupado'
  ];

  public static function getDescription($error_code)
  {
    return self::$descriptions[$error_code];
  }

  public function __construct($code)
  {
    parent::__construct(self::getDescription($code), $code);
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
      throw new \TurnosAPIException(TurnosAPIException::INVALID_DATE_FORMAT);
  }

  public static function isValidTime($time_str)
  {
    if (!preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $time_str))
      throw new \TurnosAPIException(TurnosAPIException::INVALID_TIME_FORMAT);

    $time = \DateTime::createFromFormat('H:i', $time_str);
    if (!$time)
      throw new \TurnosAPIException(TurnosAPIException::INVALID_TIME_FORMAT);

    $date_time = date_parse($time->format('H:i'));
    $hour = $date_time['hour'];
    $minute = $date_time['minute'];

    if (!self::isBetween($hour, 8, 20))
      throw new \TurnosAPIException(TurnosAPIException::INVALID_TIME_RANGE);

    if ($minute != 30 && $minute != 0)
      throw new \TurnosAPIException(TurnosAPIException::INVALID_APPOINTMENT_TIME);
  }

  public static function isValidDni($dni)
  {
    if (!isset($dni) || empty($dni))
      throw new \TurnosAPIException(TurnosAPIException::INVALID_DNI);

    if (!self::getPatientsRepository()->dniExists($dni))
      throw new \TurnosAPIException(TurnosAPIException::DNI_NOT_EXISTS);
  }

  public static function getAppointmentsRepository()
  {
    return new \AppointmentsRepository;
  }
}