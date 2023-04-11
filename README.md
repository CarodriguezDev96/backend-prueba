<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Prerrequisitos

Antes de comenzar con la instalación de WAMP, Composer y Laravel, asegúrate de tener los siguientes prerrequisitos instalados en tu sistema:

Git: para clonar el repositorio del proyecto.
PHP: asegúrate de tener PHP instalado en tu sistema. Puedes verificar la versión de PHP usando el comando php -v en tu terminal.
Composer: asegúrate de tener Composer instalado en tu sistema. Puedes verificar la versión de Composer usando el comando composer -v en tu terminal.
WAMP: descarga e instala WAMP desde https://www.wampserver.com/en/

## Instalación

Una vez que hayas verificado que los prerrequisitos están instalados, puedes seguir los siguientes pasos para instalar y configurar el proyecto Laravel:

- Clona el repositorio del proyecto usando Git:
git clone https://github.com/CarodriguezDev96/backend-prueba.git

- Crea una nueva base de datos en MySQL a través de phpMyAdmin o utilizando el comando mysql en tu terminal:
CREATE DATABASE backend_prueba;

- Instala las dependencias de Composer en tu proyecto:
composer install

- Genera una nueva clave de aplicación:
php artisan key:generate

- Ejecuta las migraciones de la base de datos:
php artisan migrate

- Inicia el servidor web de Laravel:
php artisan serve

- Abre tu navegador y navega a la dirección http://localhost:8000 para ver tu proyecto Laravel en acción.
