<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/pablomadariaga/evertec/81d802c6733fc19a37ac9197326fdc52a1f8c5c1/storage/app/evertec/logo_evertec.svg?token=AQPK27NGKATMS4ESIBA2SGDDEWIHM" width="400" alt="Evertec Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Configuración del proyecto

De acuerdo a los requerimientos de la prueba para desarrollo practico en el proceso de selección, estos son los puntos a seguir para la configuración del proyecto.

-   Se asume como primer punto que apache, mysql y php 8.1> ya han sido instalados y configurados en el servidor.
-   Instalar composer de manera global para nuestro sistema operativo.
-   Crear la base de datos en nuestro mysql.
-   Bajar el repositorio al servidor donde correremos nuesta aplicación.
-   Configurar el archivo con las variables de entorno para nuestra aplicación.
-   Bajar las dependencias del proyecto.
-   Realizar migraciones de las tablas a la base de datos y correr el proyecto.
-   Contruir aplicación front

## Instalar composer

En el siguiente enlace podemos encontrar una guía completa sobre la instalación y configuración de Composer en nuestro S.O de manera global [composer](https://getcomposer.org/doc/00-intro.md).

## Crear base de datos

Creamos la base de datos para nuestra aplicación, acontinuación podemos ver el comando para realizar esto en nuestro mysql, `nombre_bd` puede ser cualquier denominación sin caracteres especiales ni espacios.

-   CREATE DATABASE `nombre_bd` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

### Clonar repositorio
Copiamos el repositorio al root de nuestro servidor apache, _tickets_ puede ser cualquier denominación sin caracteres especiales.

-   git clone https://github.com/pablomadariaga/evertec.git _evertec_
-   Ahora ingresamos a nuestra carpeta **evertec**, de aquí en adelante los pasos a seguir son dentro de esta ruta

## Configurar .env

Después de clonar nuestro repositorio, accedemos a nuestro proyecto desde la terminal, luego debemos duplicar el archivo **.env.example** con el nombre del nuevo archivo igual a **.env** y configurar las siguientes variables.

-   comando: cp .env.example .env
-   variables
    1. APP_NAME = 'El nombre que queramos para el proyecto'
    1. APP_URL = 'Url o IP designada para correr el proyecto'
    1. PLACETOPAY_LOGIN = Credencial de PlaceToPay, identificador del sitio.
    1. PLACETOPAY_SECRET_KEY = Credencial de PlaceToPay, SecretKey para generar TranKey.
    1. DB_HOST = HOST para nuestro servidor mysql
    1. DB_PORT = PUERTO para nuestro servidor mysql
    1. DB_DATABASE = Nombre de la base de datos que creamos
    1. DB_USERNAME = Nombre de usuario de mysql
    1. DB_PASSWORD = Si el usuario tiene contraseña

## Dependencias

Ejecute los siguientes comandos desde la consola dentro de nuestra carpeta raiz del proyecto para instalar todas las dependecias de php.

-   composer i
-   php artisan config:cache
-   php artisan key:generate

## Correr migraciones para la base de datos y correr la aplicación

Ejecute los siguientes comandos desde la consola dentro de nuestra carpeta raiz del proyecto.

-   php artisan migrate:fresh --seed
    **Para finalizar corremos el servidor**
-   _php artisan serve_ , este comando no es necesario si tenemos un servidor para descubrir nuestras aplicaciones automaticamente, simplemente accedemos a la url configurada en nuestro servidor para la aplicación

## Contruir aplicación front

Ejecute el siguiente comando instalar para construir nuestros modulos de javascript y css

-   npm install && npm run build

Ahora puede acceder a la aplicación *evertec*, por medio de la ip o url designada.

Cualquier duda sobre la configuración del proyecto, puede comunicarse conmigo por medio de correo electrónico o celular. 
**+57 3146199466**
[juanpablomadariagacardona@gmail.com](mailto:mailjuanpablomadariagacardona@gmail.com)

## License

El Framework de Laravel es un software de código abierto con licencia bajo el [MIT license](https://opensource.org/licenses/MIT).
