# Bienvenidos a AxiomaFrame

## **Resumen**
***AxiomaFrame*** es un pequeño aporte al desarrollo de aplicaciones web. Se trata de un micro framework basado en PHP, implementado bajo el patrón de arquitectura MVC y que tiene como objetivo general, ayudar a los desarrolladores que no tienen tanta experiencia en la programación, a construir aplicaciones en un entorno configurado para conectar bases de datos y un set de herramientas básicas que te permitirán cumplir los objetivos de un proyectos web.

## **Características Generales**
Entre las herramientas que posee ***AxiomaFrame***, enumeramos las siguientes:
- ***Eloquent***, el mapeador de objetos relacionales utilizado por Laravel para simplificar las consultas y la manipulación de datos en una base de datos. Esta herramienta no solo supone una mejor relación con las bases de datos, sino también la posibilidad de conectarse con diversos sistemas de gestión de base de datos.
- ***Twig***, el motor de plantillas que permite mejorar la relación de las vistas del sistema con el lenguaje PHP, haciendo que el código sea mas sencillo de escribir, sin tener que usar los tag de PHP.
- ***Bootstrap***, en su versión 5.2 para lograr un buen diseño de las vistas. Se puede actualizar a la última versión disponible con solo acceder a la página oficial de Bootstrap.
- ***Clases y helpers*** que podrán ser utilizados para validar datos, controlar permisos y roles, rutas amigables y muchas cosas mas. Esto permite al desarrollador escalar su aplicación sin tener que necesariamente migrar a otro framework.

Vía Composer se pueden instalar mas herramientas necesarias para el proyecto y, por supuesto, se pueden usar paquetes para configurar y utilizar librerías y entornos como NodeJs, Bootstrap, tailswinds, etc.

## **Requisitos de Software**
Para trabajar con AxiomaFrame necesitas tener instaladas las siguientes herramientas:
- PHP 8.1 o superior.
- MySQL 8.0 o superior.
- Composer (opcional)
- Git

Para la instalación de la mayoría de estas herramientas se pueden usar paquetes tales como Xampp o WampServer (que incluyen PHP, MySQL o MariaDB, y un servidor web como Apache). Composer y Git deben instalarse por separado. La instalación de las herramientas señaladas se realiza de acuerdo al sistema operativo que uses. Otra ventaja es que estas herramientas pueden ser instaladas en cualquiera de los sistemas operativos mas conocidos, tales como, Windows, Linux y Mac.

## **Conocimientos Requeridos**
- Conocimientos básicos de Programación Orientada a Objetos.
- Conocimientos básicos de PHP
- Manejo de bases de datos a nivel básico


## **Instalación**
***AxiomaFrame*** no necesita de una compleja configuración. Basta con acceder a este repositorio, clonar o descargar y, a trabajar. Si todas las herramientas del item anterior están correctamente instaladas, el proceso de programación de tu proyecto puede comenzar sin problemas.

La documentación de ***AxiomaFrame*** permite facilitar el proceso de aprendizaje, aportando valor práctico al proceso de aprendizaje. De esta forma, puedes utilizar esta herramienta en tus proyectos e incluirle todo lo que te haga falta para conseguir los objetivos deseados.

Considera los siguientes pasos:

- Descargar o clonar el repositorio de ***AxiomaFrame*** desde su repositorio principal en https://github.com/segundogaldames/axiomaframe.
- Si lo descargas como .Zip debes descomprimirlo dentro de la carpeta de tu servidor web.
- Renombrar la carpeta recién clonada o descomprimida en el servidor con el nombre de tu proyecto.
- Crear una base de datos en mysql.
- Configurar permisos y parámetros de acceso en el archivo de configuración principal
- Revisar la documentación para solucionar posibles inconvenientes.

## **Soporte y ayuda**
Para facilitar el apoyo puedes comunicarte con segundogaldames@gmail.com

## **Corrección de problemas con Eloquent**
Si al momento de guardar datos en la base de datos utilizando Eloquent, da error de deprecación o compatibilidad desconocida o que implique a archivos que tu nunca has tocado en tu desarrollo (habitualmente relacionados con Eloquent), entonces hay un problema entre la version de PHP que estás usando con la versión de Eloquent que posee el sistema.
- Caso 1: La versión de PHP es menor que la mínima exigida por Eloquent (menor a 8.1)
- Caso 2: La versión de Eloquent es menor a la versión actual de tu PHP (mayor a 8.2)

Para solucionarlo debes realizar los siguientes pasos:
- Instalar Composer en tu computadora
- Acceder al directorio de tu servidor, donde está tu proyecto y correr el comando "composer update"

Con estas operaciones debiera restablecerse la normalidad. Si tienes algún otro problema envíame un email a segundogaldames@gmail.com

