<?php

class Appointment
{
  public $id;
  public $dni;
  public $fecha;
  public $hora;
  public $fecha_solicitud;

  public function __construct($id, $dni, $fecha, $hora, $fecha_solicitud)
  {
    $this->id = $id;
    $this->dni = $dni;
    $this->fecha = $fecha;
    $this->hora = $hora;
    $this->fecha_solicitud = $fecha_solicitud;
  }
}