<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands;

abstract class UserCommand extends Command
{

}

class AppointmentCommand
{
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

    if (!isBetween($hour, 8, 20))
      throw new \Exception("La hora debe ser entre 8:00 y 20:00");
  }

  public static function getRepository()
  {
    return new \AppointmentsRepository;
  }
}
