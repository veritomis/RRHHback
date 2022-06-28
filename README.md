# rrhh-api back
Web de microsevicios API REST FUll del ministerio

## Requerimintos
Instalacion de [docker](https://www.docker.com/products/docker-desktop)
Instalacion de [Composer](https://getcomposer.org/doc/00-intro.md)

## Configurar el entorno de desarrollo
- Crear directorio rrhh-project
- Clonar el repositorio
- cd en el directorio clonado
- Ejecute los comandos de shell a continuación

```sh
mkdir rrhh-project
cd rrhh-project
git clone https://git.produccion.gob.ar/sistema-integral-de-recursos-humanos/back.git
cd back
git fetch
git checkout develop
composer install
./vendor/bin/sail up 
cp .env.example .env
./vendor/bin/sail artisan migrate --seed 
```
## Url del servicio web por defecto
http://localhost

## Introduction
[Laravel](https://laravel.com/) es un marco de aplicación web con una sintaxis expresiva y elegante. Creemos que el desarrollo debe ser una experiencia placentera y creativa para ser realmente satisfactorio. Laravel elimina el dolor del desarrollo al facilitar las tareas comunes utilizadas en muchos proyectos web, como:

[Laravel Sail](https://laravel.com/docs/9.x/sail) es una interfaz de línea de comandos liviana para interactuar con el entorno de desarrollo Docker predeterminado de Laravel. Sail proporciona un excelente punto de partida para crear una aplicación Laravel con PHP, MySQL y Redis sin necesidad de experiencia previa en Docker.

## Configuraion alias
Configuring de Bash [Alias](https://laravel.com/docs/9.x/sail#configuring-a-bash-alias) recomendado por [Laravel Sail](https://laravel.com/docs/9.x/sail)

## Informacion de Docker-composer
- [Servidor Web](https://httpd.apache.org/).
- [Mysql](https://www.mysql.com/).
- [Redis](https://redis.io/).
- [Meilisearch](https://www.meilisearch.com/)
- [Mailhog](https://github.com/mailhog/MailHog#mailhog-----)