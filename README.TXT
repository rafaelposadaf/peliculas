//INTRUCCIONES DE INSTALACION

Requerimientos:
Base de datos: Mysql
Servidor HTTP: Apache
php 5.6 o mayor

Configuración:
base de datos: test
En la carpeta config del proyecto podrá cambiar la configuracion de la conexión a la base de datos de mysql
Por defecto usuario root y sin contraseña

Tablas requeridas:
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

INSERT INTO `users` (`id`, `nombre`, `nickname`, `password`) VALUES ('0', 'admin', 'admin', 'Admin1')

Instalacion rapida: Instale laragon de https://laragon.org/
Ejecutar scripts de base de datos para creación de tablas
Crear una carpeta dentro de laragon/www/ (sin espacios)
Dentro de esa carpeta clone el proyecto o descomprimalo
Ejecute laragon e inicie todos los servicios
Abra un navegador y dirijase a localhost/[nombre de la carpeta]
ingrese como nickname: admin Password: admin