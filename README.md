Este repositorio es un desarrollo para la gestion de usuarios y peliculas

## Requerimientos
 - Base de datos: Mysql
 - Servidor HTTP: Apache
 - php 5.6 o mayor


## Configuración
 - Crear base de datos: test
 - En la carpeta config del proyecto podrá cambiar la configuracion de la conexión a la base de datos de mysql
 - Por defecto usuario root y sin contraseña

## Tablas requeridas
CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre` varchar(80) NOT NULL,
 `nickname` varchar(80) NOT NULL,
 `password` varchar(80) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8

CREATE TABLE `movies` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `titulo` varchar(100) NOT NULL,
 `sinopsis` text,
 `anio_lanzada` char(4) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8

INSERT INTO `users` (`nombre`, `nickname`, `password`) VALUES ('admin', 'Admin1', 'Admin1')

## Instrucciones para una instalación rapida (recomendada)
 - Instale laragon de https://laragon.org/ (incluye apache,mysql y php)
 - Ejecutar scripts de base de datos para creación de tablas
 - Crear una carpeta dentro de laragon/www/ (sin espacios)
 - Dentro de esa carpeta clone el proyecto o descomprimalo
 - Ejecute laragon e inicie todos los servicios
 - Abra un navegador y dirijase a localhost/[nombre de la carpeta]
 - Ingrese como nickname: Admin1 Password: Admin1
