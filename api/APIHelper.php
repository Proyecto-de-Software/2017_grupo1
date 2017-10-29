<?php
class APIHelper
{
  private static function isBetween($value, $min, $max)
  {
    return ($value >= $min && $value <= $max);
  }

  public static function isValidDate($date)
  {
    $d = \DateTime::createFromFormat('d-m-Y', $date);
    if (!($d && $d->format('d-m-Y') == $date))
      throw new \Exception("$date no es una fecha valida, usar formato dd-mm-aaaa. Ejemplo <25-10-2017>");
  }

  public static function isValidTime($time_str)
  {
    if (!preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $time_str))
      throw new \Exception("$time_str es una hora invalida");

    $time = \DateTime::createFromFormat('H:i', $time_str);
    if (!$time)
      throw new \Exception("$time_str es una hora invalida");

    $date_time = date_parse($time->format('H:i'));
    $hour = $date_time['hour'];
    $minute = $date_time['minute'];

    if (!self::isBetween($hour, 8, 20))
      throw new \Exception('La hora debe ser entre 8:00 y 20:00');

    if ($minute != 30 && $minute != 0)
      throw new \Exception('Horario de turno invalido, debe ser cada 30 minutos');
  }

  public static function isValidDni($dni)
  {
    if (!isset($dni) || empty($dni))
      throw new \Exception('El DNI no es valido');
  }

  public static function getAppointmentsRepository()
  {
    return new \AppointmentsRepository;
  }
}