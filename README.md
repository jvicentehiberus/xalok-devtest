# README

Este repositorio contiene Prueba técnica XALOK - PHP developer test, una aplicación web donde se gestiona la reserva de vehículos por parte de los clientes.

## Instalación

### Docker

Docker es la plataforma de contenedores usada para encapsular el desarrollo local. Sigue estos pasos para instalar Docker:

1. Visita el [sitio web oficial de Docker](https://www.docker.com/get-started) y descarga el instalador adecuado para tu sistema operativo.
2. Sigue las instrucciones de instalación proporcionadas en la página de descargas.
3. Una vez completada la instalación, verifica que Docker esté funcionando correctamente ejecutando el siguiente comando en tu terminal:

```bash
docker --version
```

## Uso

A continuación, se presentan los pasos básicos para comenzar a utilizar:

1. Desde el directorio raíz del proyecto o desde la carpeta docker podremos usar distintos comando:

- Si queremos levantar el proyecto nos bastará con ejecutar:
```bash
docker-compose pull && docker-compose up -d --remove-orphans
```

### Makefile

Makefile es una herramienta que simplifica el proceso de compilación y ejecución de proyectos. igue estos pasos para instalar Makefile:

- **Linux**: Makefile generalmente viene preinstalado en la mayoría de las distribuciones de Linux. Si no lo tienes instalado, puedes hacerlo a través del gestor de paquetes de tu distribución. Por ejemplo, en Ubuntu, puedes instalarlo con el siguiente comando:

```bash
sudo apt-get install build-essential
```

- **macOS**: Para instalar Makefile en macOS, puedes usar el gestor de paquetes Homebrew. Ejecuta el siguiente comando en tu terminal:

```bash
brew install make
```

- **Windows**: Puedes instalar Makefile utilizando [Cygwin](https://www.cygwin.com/), que proporciona un entorno similar a Linux en Windows. Asegúrate de seleccionar el paquete "make" durante la instalación de Cygwin.

## Uso

A continuación, se presentan los pasos básicos para comenzar a utilizar:

1. Desde el directorio raíz del proyecto o desde la carpeta docker podremos usar distintos comando:

- Si queremos levantar el proyecto nos bastará con ejecutar:
```bash
make up
```

## Acceso a la Aplicación

Para acceder a la aplicación, abre tu navegador web y ve a la siguiente URL: [http://localhost:8080/](http://localhost:8080/). En esta página encontrarás tres bloques distintos, cada uno de los cuales te llevará a un conjunto de operaciones CRUD (Crear, Leer, Actualizar, Borrar) diferentes.


## Información del desarrollo y notas del desarrollador

Lo primero que quiero comentar a grandes rasgos, es que en 6 horas no me ha dado tiempo a aplicar todos mis conocimientos y he tenido que ir dejando cosas a medias. Por ello voy a dejar un listado de cosas que he dejado a medias y como las solucionaría si hubiera tenido más tiempo:

1. Sobre los requisitos:
    - El proyecto está hecho con PHP 8.1 y symfony 5.4.28.
    - La parte más completa y funcional es la de Vehículos, practicamente el resto sería igual que vehículos, a excepción de los viajes, que hay tendría que hacer la reserva de viajes en 3 fases, Seleccionar fecha, filtrar vehículos que no tenga viaje en esa fecha y mostrar sólo los conductores que no tengan un viaje en esa fecha y la licencia apropiada, todo esto se ira mostrando o habilitando los campos de selección conforme se complete la información.
    - Sobre el punto "Toda la lógica debe ser desarrollada en backend, utilizando buenas prácticas de desarrollo (Orientación a objeto, Principios SOLID y Buena separación de capas)" he intentado aplicarlas lo mejor posible, si es verdad que no me ha dado tiempo a separar los componentes en las distintas capas (Application, Domain, Infrastructure), tampoco he podido aplicar el uso de Value Objects, ni hacer un control de errores personalizado, decir también que es la primera vez que me enfrento a tener que hacer una web en symfony con arquitectura hexagonal, ya que hasta el momento solo había hecho APIs con este tipo de arquitectura, y no sabía muy bien cómo abordarlo.
    - Pruebas a nivel unitario, no están completas, y no están perfectas, me hubiera gustado hacer un mock mejor de bbdd para las pruebas, pero por tiempo fue lo más rápido que supe hacer
    - Repo en Github: [https://github.com/jvicentehiberus/xalok-devtest](https://github.com/jvicentehiberus/xalok-devtest)
    - Se usa Bootstrap de la mano de webpack
    - Hay algunas validaciones JS vainilla en la parte frontal, solo de un formulario, algo rudimentario con un alert, lo suyo sería marcar el input de rojo y poner el curso, pero por tiempo creia que habia cosas mas importantes

2. He dejando en ``docker/docker-compose.yml`` comentado el servicio de ``traefik`` que es un servidor proxy inverso, una de las cosas que hace es Gestión de Certificados SSL/TLS, es decir podremos acceder a la web via url y por el puerto https. Como esto se suple con una funcionalidad nueva de ``Visual Code Ports``, en la terminal del editor lo podremos encontrar y hacer las veces del servicio  ``traefik``


### ¡Listo! Ahora estás listo para comenzar a trabajar. Espero que este README te sea útil. Si necesitas más ayuda, no dudes en preguntar.
