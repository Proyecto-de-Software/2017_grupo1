<?php

function isBetween($value, $min, $max)
{
  return ($value >= $min && $value <= $max);
}

function validateDate($date, $body)
{
    $d = DateTime::createFromFormat('d-m-Y', $date);
    if (!($d && $d->format('d-m-Y') == $date))
    {
      $body->write("Fecha invalida: $date");
      return false;
    }

    return true;
}

function validateDni($dni, $body)
{
  if (!isset($dni) || empty($dni))
  {
    $body->write("DNI invalido");
    return false;
  }

  return true;
}

function validateTime($time_str, $body)
{
  if (!isset($time_str))
  {
    $body->write("Hora invalida");
    return false;
  }

  if (!preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $time_str))
  {
    $body->write("Hora invalida: $time_str");
    return false;
  }

  $time = DateTime::createFromFormat('H:i', $time_str);
  if (!$time)
  {
    $body->write("Hora invalida: $time_str");
    return false;
  }

  $date_time = date_parse($time->format('H:i'));
  $hour = $date_time['hour'];
  $minute = $date_time['minute'];

  if (!isBetween($hour, 8, 20))
  {
    $body->write('La hora debe ser un valor entre 8 y 20');
    return false;
  }

  if ($minute != 30 && $minute != 0)
  {
    $body->write('Horario de turno inválido, debe ser cada 30 minutos');
    return false;
  }

  return true;
}