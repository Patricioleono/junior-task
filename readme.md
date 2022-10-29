###################
Prueba Tecnica Solutoria
###################

Para poder solucionar esta prueba trabaje con las siguientes tecnologias.
- *[Codeigniter 3](https://www.codeigniter.com/userguide3/index.html).*
- *[PHP 7](https://www.php.net/manual/es/).*
- *[Jquery 3.5.1](https://api.jquery.com/category/version/3.5/).*
- *[Ajax](https://developer.mozilla.org/es/docs/Web/Guide/AJAX).*
- *[Bootstrap 5.0](https://getbootstrap.com/docs/5.2/getting-started/introduction/).*
- *[DataTables](https://datatables.net/).*
- *[Xampp](https://www.apachefriends.org/es/index.html).*
-*[MySql](https://www.mysql.com/)*

###################
Base de Datos
###################

Como comente mas arriba la aplicacion no crea automaticamente la base de datos, la creamos manual, accediendo a phpmyadmin, desde el control de xampp, en la interfaz podremos crear la base de datos, que en nuestro caso se llama *tarea* la cual tiene una tabla que se llama *indices*.
creando la base de datos podremos proceder a usar la aplicacion, de lo contrario no tendremos donde insertar nuestros datos.

###################
Procesos
###################

Primero tenemos que tener instalado Xampp, para poder iniciar una instancia en local, con esto podemos ver en vivo los cambios de nuestro programa en php,
tambien nos sirve para poder manejar el motor de base de datos MySql, a travez de phpmyadmin, con esto gestionamos las bases de datos.

lo primero que tenemos que tener en cuenta que nuestra aplicacion no crea la base de datos de manera automatica, este proceso lo realice manual,
una vez instalado xampp lo iniciamos, para eso le acemos click en start - apache - mysql.

para poder acceder a la aplicacion tenemos que buscar en la carpeta que se instala por defecto xampp
C:/xampp/htdocs/aqui pegamos la carpeta que contiene el proyecto, asi podemos acceder mediante el navegador tipando localhost/"nombre de la carpeta del proyecto".

con esto podemos visualizar el proyecto en el navegador.

###################
Proyecto
###################

El proyecto consta de una obtencion de token, una solicitud a la api, en conjunto con el token solicitado, esto para obtener los datos del indice,
una vez realizado esto se insertan los datos en la base de datos, y los podemos visualizar modificar eliminar y ver el grafico a nivel general.

