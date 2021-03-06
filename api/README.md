# API de Turnos

Consiste en una API REST que provee servicios para consulta y reserva de turnos

**URL base**:

`https://grupo1.proyecto2017.linti.unlp.edu.ar/api/`

## Consideraciones generales

Los endpoint todos devolverán un objeto `JSON`. Si el requerimiento es procesado correctamente, la respuesta será un `HTTP 200 OK`.

La API validará todas las entradas, indicando los errores en la respuesta utilizando `HTTP 400 Bad Request` y devolverá un codigo de error indicando cual es el problema. Este campo se incluye en el objeto `JSON` con el nombre `error_code`; cuyo  significado puede consultarse en el endpoint `/error_code/{:id_error_code}`

## Endpoints

1. `'/'` --> Documentación

Un requerimiento `HTTP GET` a la URL `'/'` retorna este documento

2. `'/turnos/{:fecha}'` --> Lista de turnos disponibles

Se debe enviar un requerimiento `HTTP GET` a la URL `/turnos/{:fecha}`.

El parametro fecha incluido en la URL debe tener el formato: `dd-mm-yyyy`, por ejemplo: `10-10-2017`. Si se omite, el valor es el dia actual (hora servidor)

La respuesta es un array `JSON` que contiene los horarios de turno disponibles para la fecha solicitada. La hora se devuelve en formato `hh:mm`

    HTTP 200 OK

```JSON
[
  "08:00",
  "08:30",
  "10:30"
]
```

3. `'/consulta-turnos/{:fecha}'` --> Lista de turnos

Se debe enviar un requerimiento `HTTP GET` a la URL `/turnos/{:fecha}`.

El parametro fecha incluido en la URL debe tener el formato: `dd-mm-yyyy`, por ejemplo: `10-10-2017`. Si se omite, el valor es el dia actual (hora servidor)

La respuesta es un array `JSON` que contiene la informacion de los turnos en la fecha solicitada:

    HTTP 200 OK

```JSON
[
  {
    "id": "1",
    "dni": "37058719",
    "fecha": "25-10-2017",
    "fecha_solicitud": "20-10-2017",
    "hora": "10:30"
  }
]
```

4. `'/turnos'` --> Reservar turno

Se debe enviar un requerimiento `HTTP POST` a la URL `/turnos`.

La solicitud debe incluir en el `body` un objeto `JSON` en donde se indiquen los siguientes parametros: DNI, Fecha y Hora

Ejemplo:

    HTTP 200 OK

```JSON
{
  "dni": "37058719",
  "fecha": "25-10-2017",
  "hora": "10:30"
}
```
Los tres parametros serán validados:

* `dni` debe ser el de un paciente registrado en el sistema
* `fecha` debe estar en formato `dd-mm-aaaa`. Ejemplo `25-10-2017`
* `hora` debe estar en formato `hh:mm`. Además los turnos son cada 30 minutos y el rango disponible en el que el hospital atiende es desde las `08:00` hasta las `20:00`.
  * Ejemplos validos: `08:00`, `10:30`, `18:00`
  * Ejemplos no validos: `08:15`, `10:34`, `21:00`


  Esto devuelve una respuesta en donde el `body` es un objeto `JSON` con la siguiente estructura:

    HTTP 200 OK

```JSON
{
    "message": "string",
    "appointment": {
        "dni": "string",
        "hora": "hh:mm",
        "fecha": "dd-mm-aaaa",
        "id": "integer"
    }
}
```
Donde:

* `message`: contiene un texto descriptivo del resultado de la operación
* `appointment`: es un objeto `JSON` que contiene la información del turno reservado. Se agrega un campo `id` que es el identificador asignado por el sistema
* `error_code`: este campo unicamente se incluye  cuando la respuesta `HTTP` vuelve con un `Status Code 400 Bad Request`. Es un codigo de error cuyo significado puede consultarse en el endpoint `/error_code/{:id_error_code}`

#### Ejemplo turno reservado correctamente:

    HTTP 200 OK

```JSON
{
    "message": "Te confirmamos el turno nro 3 para 37058719, a las 08:00 del dia 30-10-2017",
    "appointment": {
        "dni": "37058719",
        "hora": "08:00",
        "fecha": "30-10-2017",
        "id": "3"
    }
}
```
#### Ejemplo error:

    HTTP 400 Bad Request

```JSON
{
    "error_code": "1",
    "message": "El turno solicitado ya se encuentra ocupado",
    "appointment": {
        "dni": "37058719",
        "hora": "08:00",
        "fecha": "30-10-2017",
        "id": ""
    }
}
```

5. `'/error_code/{:id_error_code}'` --> Consulta de código de error

Se debe enviar un requerimiento `HTTP GET` a la URL `/error_code/{:id_error_code}`.

El parametro fecha incluido en la URL es un identificador del código de error que se quiere consutlar

La respuesta es un objeto `JSON` con la siguiente estructura:

    HTTP 200 OK

```JSON
{
  "id": "1",
  "description": "El turno solicitado ya se encuentra ocupado"
}