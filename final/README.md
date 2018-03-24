# Proyecto de Software - Cursada 2017

### Hospital Gutiérrez - Consultorio del Niño Sano

### Trabajo de promoción

#### Agustin Ortu, 11329/6

Aplicación web desarrollada para el Hospital Gutiérrez

Entre sus características, se encuentran:

  1. Administrar los **usuarios** que acceden al sistema; se cuenta con un esquema de **roles** y **permisos** para autorizar las diversas funcionalidades; estos respetan el patron **modulo-accion**
  2. Administrar los **pacientes** del hospital
  3. Administrar las **historias clínicas** de los pacientes
  4. **Reportes gráficos** de los pacientes, basados en los controles clínicos:
		- Curva de crecimiento
		- Curva de talla
		- Curva de percentil perímetro cefálico
  5.  **Gráficos estadísticos** de los pacientes, de acuerdo a sus datos demográficos (DNI, tipo de vivienda, entre otros)
  6. Las curvas y los gráficos se pueden **exportar a PDF**
  7. Ofrece una API RESTful para administrar **turnos médicos**
  8. Posee integración con [Telegram](https://telegram.org/), a través de un [bot](http://t.me/ortu_agustin_proyecto_bot), para **consultar** y **reservar** turnos médicos

### Características técnicas

1. Aplicación web [PHP](http://php.net/) como mìnimo **versión 5.6.30**, aunque también funciona sin modificaciones en PHP 7.x
2. Backend desarrollado con el framework [Laravel](https://laravel.com/) **versión 5.4**
3. **Independiente de la base de datos**: gracias a la abstracción brindada por el framework, se puede configurar para utilizar cualquiera de las [bases de datos soportadas por Laravel](https://laravel.com/docs/5.4/database#introduction)
4. Frontend desarrollado con el framework [Vue](https://vuejs.org/)
5. Integracion con [Algolia](https://www.algolia.com/) para realizar búsquedas y filtros muy potentes
6. Graficas implementadas con [ChartJS](http://www.chartjs.org/)

### Fundamentación sobre el framework elegido

En este trabajo se utilizo el framework de desarrollo [Laravel](https://laravel.com/), en su version 5.4 que es la más reciente compatible con PHP 5.6; las versiones posteriores requieren PHP 7 y por lo tanto no han sido contempladas en este desarrollo.

Laravel es software libre (licencia MIT). Es un framework para desarrollo web MVC que se ha hecho muy popular en la comunidad PHP. Una de las cuestiones por la que me resultó cautivador es que es muy sencillo de aprender, permite escribir código muy simple, elegante y respetando las mejores practicas de diseño orientado a objetos; de hecho, el framework esta construido y pensado para guiar al desarrollador a que también respete estas buenas practicas. Si uno visita [el sitio web](https://laravel.com/) se puede ver que su eslogán es "The PHP Framework For Web Artisans", lo cual podría traducirse en algo como "El Framework PHP para Artesanos de la Web".

A su vez, es un framework relativamente nuevo (la primer release fue en 2011) por lo que podría decirse que han tomado lo mejor de los distintos frameworks existentes (incluso de otros lenguajes) y lo han compilado en un único producto. Esto en particular me ha servido para familiarizarme más rápido y sentirme muy cómodo con el desarrollo. Si bien mi experiencia con frameworks web no es muy grande, durante la cursada de Taller de Ruby utilizamos [Rails](http://rubyonrails.org/), que también es un framework web; es un poco más viejo pero no por eso ha perdido vigencia; de hecho, ha inspirado a muchos otros frameworks. En por esto que lo aprendido con Rails es perfectamente aplicable a Laravel, sobre todo las convenciones: desde como se nombran y donde se ubican los archivos, como se llaman las clases, como se accede a la base de datos, como se mapean los objetos persistentes a la base de datos, que metodos provee el ORM para las operaciones CRUD, el concepto de las migraciones, entre otras, han hecho que me sienta muy cómodo durante el desarrollo, casi en casa.

Laravel tambìén maneja de manera muy similar a Rails el concepto de "ambiente", es decir, el entorno de ejecución de la aplicación, como se configura la misma al ejecutarla; no se configura igual la aplicación en producción, en desarrollo o en tests. Por ejemplo, para desarrollo, si ocurre una excepción, se muestra una pagina con la traza de ejecución, es decir, mucha información que podria ser sensible. En tests, quiza sea conveniente conectarse a otra base de datos para realizar las pruebas y no con una base de datos real. Esto se logra configurando, por cada ambiente, las distintas variables de entorno, o bien utilizando archivos con extension .env, en donde se definen pares "clave=valor" donde la clave es el nombre de la variable de entorno. Para acceder al valor, se usa la funcion `config()`

También es interesante remarcar que como se trata de un ecosistema "moderno", han incorporado también herramientas para ayudar al desarrollador que podrían considerarse "de facto" para cualquier desarrollo web; por ejemplo, al crear un proyecto, este ya viene preparado con librerias JavaScript que se utilizan practicamente en cualquier desarrollo, como jQuery, y otras librerias auxiliares como [axios](https://github.com/axios/axios) que es utilizada para realizar peticiones AJAX, y también contempla una inicialización de la misma en donde [se incluye un token](https://laravel.com/docs/5.4/csrf#csrf-introduction) en las peticiones HTTP que es requerido en el backend por cuestiones de seguridad, para prevenir ataques CSRF (más adelante se explica); o [Vue](https://vuejs.org/) que es un framework JavaScript para el frontend.

Además, la instalación por defecto también contempla [Webpack](https://webpack.js.org/) que se encarga de empaquetar los recursos (assets), es decir, archivos de estilo (.css, .sass, etc) y javascripts (.js) para que estos puedan ser servidos en producción de manera eficiente: por ejemplo, se compila todo los javascript en un unico archivo, el cual a su vez es comprimido y minificado para reducir su tamaño, y esto permite que los navegadores hagan un unico request para descargar ese archivo y luego cachearlo; esto se traduce en ahorro de datos, ahorro de peticiones/respuestas HTTP, y en webs que funcionan más rapido. Esto también nos permite modularizar los archivos js, escribir usando sintaxis ES6, y luego pasa por un transpiler le cual lo convierte a "vanilla javascript" y esto nos asegura que pueda correr en cualquier navegador.

No todo es librerias externas o herramientas; el framework también está preparado para soportar autenticacion y autorización de manera casi automatica; esto es debido a que estos son requisitos de virtualmente **todas** las aplicaciones que hoy en dia se desarrollan. Con ejecutar un simple comando, se puede obtener un MVC completo para gestionar usuarios, autenticarlos, y luego pasar a configurar la autorización.

También provee una herramienta que se ejecuta por consola, llamada [Artisan](https://laravel.com/docs/5.4/artisan). Provee una serie de comandos para asistir en el proceso de desarrollo y en la puesta en producción de la aplicación. Hay comandos para generar archivos, desde Vistas, Modelos, Controladores, Test de Unidad, Test Funcionales, entre otros. Estos archivos generados tienen una estructura o plantilla, y se ubican en carpetas particulares, que no sólo ayuda a desarrollar más rápido, sino qué también, al respetar todos una estructura similar, y estar ubicados en donde corresponde, el desarrollador escribe código que es más consistente, y que otro podría leer más fácilmente ya que todos seguiriamos el mismo "estandar"

Otro factor muy importante es la [documentación](https://laravel.com/docs/5.4), la cual sigue la filosofia del framework: es muy clara, está muy bien estructurada, y explica desde los casos de uso más simples y comunes hasta cuestiones más avanzadas para casos más particulares.

El factor comunidad, ya se mencionó que es muy popular, de hecho, es el [framework para desarrollo web con PHP más popular](https://coderseye.com/best-php-frameworks-for-web-developers/). Si lo comparamos por ejemplo con [Symfony](https://symfony.com/) y [Yii](https://www.yiiframework.com/), en cuanto a paquetes de terceros listados en [Packalyst](https://packalyst.com/), [Laravel es el ganador (ver Extendability)](https://opensource.com/business/16/6/which-php-framework-right-you).

También quiero destacar el sitio [LaraCasts](https://laracasts.com/). Para los "rubystas", es la versión PHP+Laravel de [RailsCasts](http://railscasts.com). En pocas palabras, es un sitio en donde una persona realiza una sesión de codificación usando el framework (o tecnologias relacionadas o de interés, por ejemplo, para la parte del frontend), a medida que va explicando la tematica en cuestión. Podría decirse que es como una especie de video-tutoriales, en donde en pocos minutos se aprende una nueva técnica. Lo interesante de estos dos sitios es que su éxito es debido a la gran habilidad de quién realiza las presentaciones. De hecho, LaraCasts es un partener oficial de Laravel, ya que aparece el link al mismo en el sitio oficial del framework, e incluso es recomendado; incluso el propio creador del framework Laravel ha realizado algunas presentaciones en este sitio. Por último, también cuenta con un [foro](https://laracasts.com/discuss) en donde se puede enonctrar más material y realizar consultas

### Referencias

* [Laravel, sitio oficial](https://laravel.com/)
* [LaraCasts](https://laracasts.com/)
* [How to choose a PHP framework](https://opensource.com/business/16/6/which-php-framework-right-you)
* [PHP Framework Comparison 2018: CodeIgniter vs Laravel vs Yii vs CakePHP](https://medium.com/@therightsw.com/php-framework-comparison-2017-codeigniter-vs-laravel-vs-yii-vs-cakephp-d2a6d4dd0fb7)
* [11 Best PHP Frameworks for Modern Web Developers in 2018](https://coderseye.com/best-php-frameworks-for-web-developers/)
* [Sobre seguridad (CSRF, XSS, SQL Injection)](https://www.easylaravelbook.com/blog/how-laravel-5-prevents-sql-injection-cross-site-request-forgery-and-cross-site-scripting/)
* [Laravel 5's Key Security Features](https://www.easylaravelbook.com/blog/laravel-key-security-features/)
* [Sobre las vistas](http://geekhmer.github.io/blog/2017/08/06/laravel-5-dot-x-x-template/)

### Modulos reutilizados del TP desarrollado durante la cursada

En mi caso no hubo reutilización, al menos no de manera directa (es decir, referenciando al mismo archivo). Esto se debe a que, como mencioné arriba, el framework me provee de una estructura, una guia que me resultó más productiva, consistente y clara a la hora de trabajar. Luego también está la realidad de que los frameworks son mucho mas potentes que un desarrollo a "PHP plano" y tienen cuestiones ya resueltas que uno puede aprovechar, siendo soluciones mas completas, probadas y establecidas que algo "casero".

Un ejemplo podrian ser las validaciones de los campos ingresados por los usuarios. En el TP de la cursada, realizabamos validaciones muy sencillas, campo a campo en los controladores; basicamente una serie de ifs para verificar cuestiones como, "no sea vacio o nulo", "sea numerico", etc. Si alguna verificacion fallaba, no se realizaba la persistencia en la base de datos y mostrabamos un mensaje de error generico indicando que "algún" (¿cuál, podría pensar el usuario?) campo no superó una validación (de nuevo, ¿cuàl?).
Con Laravel, uno puede indicar como se valida cada campo utilizando lo que se conocen como [Reglas](https://laravel.com/docs/5.4/validation). Una clase encargada de realizar validaciones (Validator) recibe el input, las reglas, las corre todas y luego devuelve un true si todas fueron exitosas, y en caso de falso tambien devuelve una colección de mensajes, para cada campo, con un texto indicando los motivos por los que la validación falla. Además, Laravel también se encarga de generar una respuesta HTTP apropiada, con un código de error 422 que indica que no se pudo procesar el requerimiento por errores de validación, y cargar estos datos en la sesión para poder mostrar la información al usuario. Además de esto, las validaciones que provee el framework incluyen cuestiones como verificar mails, registros duplicados, validacion de formatos de fechas, horas, expresiones regulares, etc.

Para poder explotar al máximo el framework, y siguiendo con el caso anterior, es necesario reescribir los controladores, y algo de las vistas. Cómo tampoco estaba muy contento con las vistas que creamos durante la cursada, y también tenia ganas de meter un poco de javascript/ajax/framework en el frontend, también opté por rehacer las vistas. Con respecto al modelo, si bien es posible utilizar modelos ya existentes, hay que configurar Laravel para que esto sea posible; es mucho menos trabajo (y también más natural) seguir las convenciones y utilizar el mapeo automático. Además quiero volver a recalcar el tema de la consistencia en cosas que algunos quizá consideran triviales como los nombres de los campos y las tablas (si son plurales, singulares, en español, en ingles, usando notacion camel case o separando con guiones, etc), en nuestro trabajo intentamos pero no logramos ser 100% consistentes. Con un framework que te aconseja seguir convenciones, si uno realmente las sigue, el modelo resulta mas consistente y claro. Y ésta es la razón por la que también decidí rehacer el modelo, y también aprovechar para tomar ventaja de las migraciones de Laravel, lo que me permite ser "agnostico" de la base de datos, y practicamente poner en marcha la aplicaciòn usando cualquier base de datos sin preocuparme por detalles como: como se implementa el boolean, si soporta claves foraneas, indices, restricciones, cascadeo, etc. La aplicación desarrollada corre, sin modificación alguna en [PostgreSQL (ver Demo en Heroku)](https://www.postgresql.org/), [Sqlite 3 (usado localmente para desarrollar)](https://www.sqlite.org/index.html) y [MySQL/MariaDB](https://www.mysql.com/)

Por motivos como este, y muchos más, es preferible aprovechar todas las características que provee el framework y explotarlas al máximo para realizar un desarrollo de mayor calidad, tanto a nivel calidad interna como externa, y opte por una reimplementaciòn casi total de la aplicación.

### Seguridad

#### [Protección CSRF](https://laravel.com/docs/5.4/csrf)

Laravel utiliza el concepto de "middleware", qué no es más que una pila de capas por las cuales pasa un requerimiento HTTP hasta que realmente es atendido. Cada capa "hace algo" con el requerimiento HTTP y se lo pasa a la siguiente (o eleva una excepción) hasta que finalmente llega al router quien se lo despacha al controlador correspondiente. Una de estas capas es la que se encarga de defendernos de [ataques CSRF](https://en.wikipedia.org/wiki/Cross-site_request_forgery). En pocas palabras, es una vulnerabilidad, que de ser explotada, permite a un tercero realizar acciones o ejecutar comandos sin el consentimiento de un usuario que **está autenticado** en la aplicación y tiene **permiso** para ejecutar el comando en cuestión. Un ejemplo muy sencillo es un link el cual al ser clickeado elimina un registro; si yo conozco como podria ser la URL de ese link, y se lo envío a un usuario, éste, al visitarlo, termina invocando dicha acción.

La protección que brinda Laravel es generar un token para cada sesión, el cuál es utilizado para verificar que realmente es el quién está enviando la solicitud, es decir, con su consentimiento. Esto también nos obligará a incluir un campo especial, oculto (en HTML input type=hidden), con dicho token. De esta manera, el token viaja como parte del input, y el middleware chequeará que el token del requerimiento y el que se generó para el usuario, coincidan.

Esto también aplica para el caso de AJAX, en donde se debe incluir un header especial con dicho token.

#### Injección SQL

Del mismo modo que durante el trabajo de la cursada, Laravel usa PDO para conectarse a las bases de datos, y también utiliza parámetros para evitar injecciones SQL

#### [Proteccion XSS](https://laravel.com/docs/5.4/blade#displaying-data)

Laravel usa un motor de plantillas que se llama Blade; es muy similar a Twig, que es el motor de Symfony, y que utilizamos en el curso. Blade permite imprimir variables o funciones en las vistas usando la sintaxis `{{ $variable|funcion() }}`. Al hacerlo, esto antes pasa por la función `htmlspecialchars` que previene ataques XSS. Si se quiere evitar este "filtro", se debe utilizar la sintaxis `{!! $variable|funcion() !!}`; esto puede ser seguro o no dependiendo de que es lo que se está imprimiendo; si se trata de valores que pueden cargar los usuarios, se abre una brecha de seguridad que permite a un atacante explotar la vulnerabilidad XSS; por ejemplo, podria ejecutar javascript, agregar elementos HTML, etc

### [Ruteo](https://laravel.com/docs/5.4/routing)

Laravel tiene archivos especiales para definir las rutas de la aplicación. Estos archivos están en el directorio `/routes` y existen distintos tipos de rutas, donde cada uno de estos conforma un "grupo de rutas". Esto se implementó de esta manera para aplicarle distinta funcionalidad, en forma de middlewares, a las rutas de acuerdo a su proposito.

Por ejemplo, en el archivo `/routes/api.php` se deben definir las rutas que basicamente no renderizarán una vista, sino que simplemente responderán con JSON o XML.

En general, el archivo en donde más rutas se definen es en `/routes/web.php`, por lo que Laravel crea un grupo llamado "web", y asigna una serie de middlewares que implementan la proteccion CSRF, encriptación de cookies, autenticación, autorización, manejo de las sesiones, etc. Para definir una ruta, se usa alguno de estos metodos, según corresponda:

```php
Route::get($uri, $callback|controller@method);
Route::post($uri, $callback|controller@method);
Route::put($uri, $callback|controller@method);
Route::patch($uri, $callback|controller@method);
Route::delete($uri, $callback|controller@method);
Route::options($uri, $callback|controller@method);
```

Es decir, se indica cual es el metodo HTTP, y luego un "callback" (una función anonima), o un string en donde se respeta la convención `NombreControlador@metodo`, es decir, se indica a que controlador y a que método particular se debe enviar el requerimiento en cuestion

En las rutas también se pueden definir parametros, por ejemplo, para mostrar un usuario:

```php
Route::get('user/{id}', 'UsersControllers@show');
```

Si se agrega un `?` estamos indicando que el parámetro opcional

Existe un mecanismo que permite, siguiendo la filosofia REST, definir rapidamente un recurso y su controlador, y esto genera las rutas para todos los metodos RESTful (aunque se puede indicar que se quieren omitir algunos), por ejemplo:

```php
Route::resource('roles', 'RolesController');
```

Por último, tambíen se puede aplicar un middleware a un grupo de rutas en particular; esto fue utilizado para definir cuales son las rutas que en principio, es necesario estar autenticado (y posiblemente, tener además autorización) para acceder:

```php
Route::middleware('auth')->group(function () {
  // definicion de rutas para los cuales se aplica el middleware "auth"
});
```
### CRUD

Laravel utiliza un ORM llamado Eloquent el cual implementa el patrón ActiveRecord. Es indispensable que los modelos que se crean, subclasifiquen una clase llamada "Model" que sabe como conectarse a la base de datos e implementar las CRUD. Si se respetan las convenciones y no se configura nada, Laravel sabe convertir palabras en inglés de singular a plural y visceversa, por lo que utilizará el nombre de la clase en plural y en minusculas para saber a que tabla de la base de datos se mapea el modelo.

Por ejemplo, en el trabajo se define el modelo `Patient` que se persistirá en la tabla `patients`. Para casos con nombres de clases compuestos, como `MedicalRecord`, la tabla debería llamarse `medical_records` (esto se conoce como notación "snake case")

Otra convención tiene que ver con la clave primaria. Laravel asumirá que la misma se llama `id`, y que es un entero autoincremental.

También es posible tener modelos que se conectan a distintas bases de datos, o con distintos parametros de conexión, pero por defecto todos usarán la conexión segun la configuración del ambiente.

##### Read: recuperando modelos

Si bien hay una gran cantidad de metodos para traerse información de la base, alguno de los más comunes son:

```php
  $patients = Patient::all(); // devuelve una colección de pacientes
  $patients = Patient::where('phone', '1234')->get(); // devuelve una coleccion de pacientes con telefono '1234'
  $patients = Patient::where('phone', '1234')->orderBy('name', 'asc')->get(); // devuelve una coleccion de pacientes con telefono '1234' y ordenados por nombre
```
Para recuperar **un solo** modelo:

```php
  $patient = Patient::find(1); // devuelve el paciente con id=1
  $patient = Patient::findOrFail(1); // devuelve el paciente con id=1, y si no lo encuentra, eleva una excepcion
  $patient = Patient::where('phone', '1234')->first(); // devuelve el primer paciente con telefono '1234'
```
Luego es posible acceder a los campos del modelo, respetando los nombres de las columnas de la tabla:

```php
  $patient = Patient::find(1);
  $patient->name;
  $patient->phone;
  // etc
```
##### Create: creando modelos

Existen multiples formas de insertar modelos en la base de datos, la más sencilla consiste en instanciar un modelo y luego invocar al metodo `save()`:

```php
  $patient = new Patient;
  $patient->name = 'Agustin';
  // asignar mas campos
  $patient->save();
```

Tambien es posible utilizar el metodo de clase `create()`, el cual recibirá un arreglo asociativo donde la clave es el nombre del campo, y el valor, el valor que se desea guardar, y retornará la instancia persistida en la base de datos:

```php
  $patient = Patient::create([
    'name' => 'Agustin',
    // mas campos
  ]);
```

Existen más variaciones:

`firstOrCreate` es un metodo de clase similar a `create`, pero solo creará y persistirá el modelo si este no existe; si no, lo crea y lo retorna
`firstOrNew` similar al anterior, pero en este caso lo **no** se persiste

#### Update: actualizando modelos

Es muy similar a la creación, el caso más simple posible consiste en recuperar un modelo de la base de datos, cambiar los atributos que se deseen, y luego invocar a `save()`

```php
  $patient = Patient::find(1);
  $patient->name = 'Agustin';
  // asignar mas campos
  $patient->save();
```

Laravel entenderá que es un modelo ya persistido y realizará una actualización en la base de datos en lugar de una inserción.

También es posible realizar actualización en masa, es decir, actualizar varios modelos, incluso indicando que se cumpla una condición en particular:

```php
  Patient::where('phone', '1234')->update(['phone' => '5678']); // actualizar el telefono de todos los pacientes con telefono 1234 a 5678
```

También tenemos la forma `updateOrCreate` actualizará el modelo si este existe, y si no lo creará

#### Delete: eliminando modelos

De nuevo, la forma más fácil consiste en recuperar un modelo, y luego invocar al metodo `delete()`

```php
  $patient = Patient::find(1);
  $patient->delete();
```

Es posible tambien eliminar uno o mas modelos usando el metodo de clase `destroy()`; también nos ahorramos una lectura de la BD

```php
  $patient = Patient::destroy(1); // elimina el paciente con id=1
  $patient = Patient::destroy([1, 2, 3]); // elimina el paciente con ids=1, 2 y 3
```
También es posible incluir condicionales con where:

```php
  Patient::where('phone', '1234')->delete(); // elimina todos los pacientes con telefono 1234
```

### MVC

Laravel es un framework que implementa el patron Model-View-Controller. El modelo fue analizado en el punto anterior (CRUD), en donde se dispone de un ORM que implementa ActiveRecord para acceder a la base de datos

No existe un directorio particular para almacenar los modelos, pero en un principio es aconsejable hacerlo en el directorio `/app`, que es en donde Artisan creará los modelos si se usan sus comandos. Si la aplicación crece mucho, se podría crear un árbol de directorios que ayude a manejar de forma más conveniente la aplicación. Solamente es necesario que `Composer` este configurado para realizar el autoloading; en definitiva, si se crea la estructura de directorios que uno prefiera bajo el directorio `/app`, no hace falta configurar nada más.

#### Las vistas (View)

Las vistas son basicametne formadas por HTML y una sintaxis especial que entiende el motor de plantillas que se llama Blade. Se espera que los archivos (que si bien no es necesario, es aconsejable que tengan extensión .blade.php por cuestiones de legibilidad) se encuentren en el directorio `resource/views`. Los controladores pueden retornar una respuesta HTTP indicando el nombre de la vista que se debe renderizar, y opcionalmente una serie de variables que la vista podrá acceder, por ejemplo:

```php
  return view('home', ['name' => 'Agustin']);
```

Del mismo modo que los modelos, es posible crear el arbol de directorios que crea conveniente para manejar las vistas, siempre y cuando estén dentro de `resources/views`. A mi en particular me parece útil agruparlas de acuerdo al recurso y la acción invocada, siguiendo la filosofia REST, es decir:

```
  resources/views/patients --> directorio con todas las vistas para los pacientes
    resources/views/patients/index.blade.php --> vista que se renderiza cuando se pide el listado de pacientes
    resources/views/patients/show.blade.php --> vista que se renderiza cuando se pide ver un paciente
    ...etc
```

Blade es muy similar a Twig que fue utilizado en la cursada, y soporta características similares como herencia y composición de plantillas, y también es posible extenderlo para que entienda funciones o filtros que se aplican a las variables o funciones

#### Los controladores (Controller)

Los controladores son clases PHP que deben estar bajo el directorio y namespace `app/Http/Controllers` También deben subclasificar la clase `Controller`. Como ya se detalló en la sección de ruteo, es en el archivo de rutas en donde se indica al framework que controlador atenderá los diferentes requerimientos HTTP.

### Vue

Para el frontend se usó el framework [Vue](https://vuejs.org/). Es similar a [React](https://reactjs.org/) o [Angular](https://angular.io/). Vue es bastante sencillo, la idea en general es mejorar la interacción y la experiencia de usuario de una página. Es un framework que se autodefine "progresivo", y esto significa que uno lo puede ir agregando "de a poco", o en partes particulares de la aplicación, es decir, es muy flexible, fácil de usar, y ofrece caracteristicas muy potentes como "reactividad" (una instancia de un componente tendrá una determinada variable, que se conecta con algun elemento de la parte visual, por ejemplo, un input, un select, etc; al modificar uno, el cambio se ve reflejado en el otro(s) inmediatamente), manejo de los eventos del DOM (incluso definir los propios). Está orientado a componentes, en donde en un unico archivo se especifica cual será el template HTML que se va a renderizar, que metodos hay disponibles, que información, datos o propiedades, y el estilo. Esto permite tener "todo junto" y "todo separado", es decir, en un solo archivo, pero con secciones bien definidas, las diferentes partes de un componente.

Luego, para usar el componente, se escribe en el HTML (en nuestro caso, con Laravel, plantillas Blade) un tag que sale derivado del nombre del componente; por ejemplo para el componente PieChart, que encapsula un grafico de tortas que sabe recuperar la información que debe mostrar realizando una peticion AJAX, en el HTML podriamos escribir algo como:

```html
<vue-pie-chart
    :endpoint="UnaUrl"
    :title="Titulo">
</vue-pie-chart>
```

Cuando Vue procese la plantilla, reemplazara los tag por el HTML correspondiente definido en el componente. En el ejemplo también se muestra como pasarle valores al componente, en este caso, como es un componente genérico que serviria para dibujar cualquier tipo de reporte, recibe una URL que indica a que dirección deberá enviar un requerimiento AJAX para obtener la información que el grafico va a mostrar.

Vue también es muy útil para encapsular ciertos HTML complejos, darles algo de comportamiento de ser necesario, y luego escribir un sencillo tag que puede ser reutilizado en cualquier parte

Por supuesto que hay muchas librerias y componentes de terceros listos para utilizar. En mi caso, por citar algunos:

* [Vue Instant Search](https://community.algolia.com/vue-instantsearch/getting-started/getting-started.html): es una serie de componentes relacionados con busquedas, filtros, para aplicaciones que utilizan como motor [Algolia](https://www.algolia.com/)
* [Buefy](https://buefy.github.io/#/): En este desarrollo se utilizo [Bulma](https://bulma.io/) como framework css. Buefy es la version "Vue" de Bulma, lo que permite acceder a componentes, alguno incluso estandar de html, pero con las ventajas que ofrece vue: reactividad, eventos, comportamiento, y demás
* [Vue ChartJS](http://vue-chartjs.org/#/): Wrapper de graficas [ChartJS](http://www.chartjs.org/) con las mejoras que Vue ofrece

Con Vue se implementaron cosas como:

- Datepicker para los formularios. El componente funciona tanto en escritorio como moviles, ajustando su presentación apropiadamente
- Botones para borrar modelos que envian una petición AJAX; cuando el servidor responde, pueden eliminar del DOM el elemento en cuestion usando una animación
- Formularios modales: en particular los de Login y Registro de usuario
- Notificaciones: son simplemente mensajes cuando se realizan determinadas acciones, por ejemplo, borrar un modelo
- Graficos de torta con los datos demograficos
- Reportes con los datos de las historias clinicas de los pacientes
- Dialogos modales, para confirmar antes de, por ejemplo, borrar un modelo
- La sección de administración
- La asignación de roles a los usuarios
- La ya mencionada integración con Algolia


### Algolia

Otra cuestión incluida en el desarrollo es [Algolia](https://www.algolia.com/), que es un motor de busquedas. Como esta integrado en Laravel de manera oficial, el uso es casi transparente. Su funcionamiento consiste en enviar los datos que uno desea indexar a un servicio externo, y luego realizar una solicitud HTTP con ciertos parametros que definen el criterio de búsqueda para obtener los resultados. Luego se pueden refinar los resultados agrupando por categoria (por ejemplo, todos los pacientes de IOMA con viviendas electricas y un determinado rango de edad). En el trabajo lo utilicè para realizar la sección de las búsquedas de los clientes. Las actualizaciones, inserciones y borrado de los modelos se reflejan en este repositorio externo de manera automática (puede tardar unos momentos en actualizar). La bùsqueda es muy potente, rápida y versatil; es capaz de entender cosas como errores de tipeo u ortograficos, por ejemplo también permite ordenar de acuerdo a criterios que van más alla de orden alfabetico o numerico, (cantidad de veces que se buscó, similaridad, etc)

Es necesario configurar estas 3 variables de entorno en el sistema para que funcione (o definirlas en el archivo .env)

ALGOLIA_APP_ID=J4ZS9TM45I
ALGOLIA_PUBLIC_KEY=5b9ed856fd80552f5c6768f038bacef6
ALGOLIA_SECRET=22a92361ef653a9a2a48639f505dce08

Algolia tiene un plan gratuito (con algunas limitaciones en la cantidad de datos que permite manejar, la cantidad de requests por dia, etc) siempre y cuando se incluya el logo en la aplicación.

### Demo

Ésta aplicación fue desplegada a la plataforma [Heroku](http://heroku.com), podés verla siguiendo [este link](https://ortu-agustin-proyecto.herokuapp.com/).

Esta precargada con algunos datos ficticios para poder probar la aplicación.

Es posible registrarse, pero existen los siguientes usuarios:

| Usuario        | Contraseña   |  Rol  |
| ------------- |:-------------:| ------:|
| admin      | admin | Admin |
| medic      | medic | Medic |
| recepcionist | recepcionist | Recepcionist |


