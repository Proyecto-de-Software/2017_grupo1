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

abstract class AppointmentCommand extends UserCommand
{
  protected function isValidDate($date)
  {
    $d = \DateTime::createFromFormat('d-m-Y', $date);
    if (!($d && $d->format('d-m-Y') == $date))
    {
      return false;
    }

    return true;
  }

  protected function getRepository()
  {
    return new \AppointmentsRepository;
  }
}
