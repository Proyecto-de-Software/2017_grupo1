<?php

class AppointmentsRepository extends PDORepository
{
  public function getAppointments($date)
  {
    $answer = array();
    $appointment = new Appointment;
    $appointment->id = 1;
    $appointment->dni = "37058719";
    $appointment->fecha = "27-10-2017";
    $appointment->hora = "10:30";
    $appointment->fecha_solicitud = "20-10-2017";
    $answer[] = $appointment;
    return $answer;
  }

  public function appoint($date, $time, $dni)
  {
    return (rand() % 2 == 0);
  }
}