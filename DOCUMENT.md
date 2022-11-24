# Documentación AxiomaFrame

## Introducción

***AxiomaFrame*** es una propuesta para el desarrollo de aplicaciones web a través de un micro framework basado en PHP, como plataforma para el backend, y el uso de diversas librerías de desarrollo que te permitirán iniciar un proyecto con un mínimo de configuraciones.

La idea principal es proporcionar un entorno básico de desarrollo, escalable según necesidades de proyectos, pero que haga simple y sencillo el proceso de inicio. Idealmente para desarrolladores con poca experiencia, pero que deseen crear proyectos web robustos y escalables.

Si quieres usar ***AxiomaFrame*** para aprender a trabajar con la arquitectura MVC, entonces, has llegado al lugar correcto, ya que la idea es ayudarte en la búsqueda de simplicidad para iniciar tu proceso de formación profesional en el ámbito de las aplicaciones web.

El set inicial propone el uso de MySQL, pero gracias al uso de PDO como libreria principal de conexión de base de datos, se pueden usar otros Sistemas de Gestión de Base de Datos Relacionales, tales como PostgreSQL u otro.

Este inicio, incluye Eloquent para la manipulación de los datos de la base de datos, pero también se pueden usar sentencias SQL mas complejas si así lo requirieras.

El versionamiento continuo de ***AxiomaFrame*** supone una serie de mejoras e implementaciones que ayuden a contribuir con tu éxito en la creación de proyectos web.

## Acerca del  Autor
El autor de este proyecto es *Segundo Galdames Henríquez*, Ingeniero en Informática y docente de Educación Superior en Santiago de Chile. Con mas de diez años de experiencia en el desarrollo de aplicaciones web y con casi una década en la formación académica, conoce la complejidad que sufren los desarrolladores nóveles o sin experiencia para comenzar a usar frameworks y librerías que suponen un marco de mejores prácticas para el desarrollo de sistemas. A veces, las configuraciones complejas matan la pasión al comienzo, pero con esta propuesta, se busca que esa complejidad baje al menos un poco.

Nada es completamente original, así que parte del código desarrollado por el autor se ha ido implementando gracias a la contribución de otros desarrolladores con mas experiencia y eso se refleja en la simplicidad, claridad y orden del código básico de ***AxiomaFrame***. Las técnicas y herramientas que se usan en el desarrollo de aplicaciones web implican el constante uso de convenciones y buenas prácticas de programación, que vamos depurando a medida que aumentan nuestras habilidades y conocimientos.

Como nada es perfecto, las sugerencias y aportes a ***AxiomaFrame*** serán bienvenidas para la mejora continua.

## Iniciando...
### Preparando el entorno de inicio
Para comenzar, debes instalar en tu computadora las siguientes aplicaciones:
- Alternativa a): **Xampp**. Ve al sitio oficial de [Xampp](https://www.apachefriends.org/es/index.html "Xampp") y descarga la versión que corresponda con tu sistema operativo. Normalmente, en Windows podrás instalar esta aplicación tal como se hace habitualmente con otras aplicaciones.
- Alternativa b): **Wampserver**. Ve al sitio oficial de [WampServer](https://www.wampserver.com/en/ "Wampserver") y descarga el software. A diferencia de Xampp, WampServer solo funciona en Windows.

Si eres usuario de Mac, te recomendamos el uso de Mamp en su versión gratuita. Puedes descargarlo desde su sitio [oficial](https://www.mamp.info/en/windows/ "oficial").

En cualquiera de los casos, estos paquetes de software te darán acceso a un servidor Apache para levantar un servidor local, MySQL como gestor de la base de datos (también conocido como MariaDB) y PHP en su última versión.

Para la solución de cualquier problema relacionado con alguna de las librerías mencionadas, debes consultar la documentación respectiva. También hay buenos tutoriales en Youtube para solucionar inconvenientes. El principal problema que a veces se produce es la disponibilidad del puerto 80 para Apache y ahí, se debe cambiar el puerto. Muchas veces se usa por costumbre el puerto 8080. Este cambio no debe hacerse para MySQL.

Otra herramienta que debes instalar antes de iniciar con ***AxiomaFrame*** es Git. Esta herramienta se usa para versionar el código y puedes acceder a su sitio [oficial](https://git-scm.com/ "oficial") para obtener la versión apropiada para tu sistema operativo. Luego de instalado Git en tu computadora, debes ingresar a alguno de los proveedores de repositorios que existen en la nube y crear una cuenta. El mas conocido es [Github](https://github.com/ "Github"), ya que te permite alojar documentos y software de manera gratuita. Hay mas opciones y dependerá de tu conocimiento, el uso de otra plataforma. De hecho, ***AxiomaFrame*** está alojado en Gilthub.

Luego de creada la cuenta, podrás crear repositorios públicos o privados en donde puedas alojar tu código, junto con las actualizaciones que realices en él.

Continuando con el set de herramientas iniciales, opcionalmente, puedes instalar [Composer](https://getcomposer.org/ "Composer"). Esta herramienta permite la instalación de paquetes y librerías de desarrollo complementarias al proyecto. Por ejemplo, la librería Eloquent, que implementa ***AxiomaFrame***, se instaló con Composer y, si tu necesitaras en el futuro de otras librerías, podrás instalarlas a través de Composer. Si quieres conocer las alternativas en cuanto a aplicaciones disponibles usando Composer, visita [La lista de paquetes](https://packagist.org/ "La lista de paquetes") publicados.

Si has instalado todas las herramientas señaladas, podríamos probar.
- Ve al panel de Xampp e inicia Apache y MySQL. WampServer y Mamp tienen sus propias formas, pero la operación es la misma.
- Abre el navegador de tu preferencia.
- Escribe en la barra de direcciones la palabra localhost.
- Si todo anda bien, verás una pantalla en la que se muestra la vista de inicio de Xampp, WampServer o Mamp, con información acerca de la versión de PHP, MySQL y PHPMyAdmin (un software que te ayudará a administrar tus bases de datos). Si no se muestra dicha página o en el navegador aparece un mensaje con información de problemas de inicio, entonces tendrás que cambiar el puerto para Apache, ya que muchas veces hay aplicaciones que pueden estar corriendo en ese puerto. La recomendación es cambiar el puerto 80 por el 8080. En ese caso, la dirección web de tu servidor local será localhost:8080.

***Los usuarios de Mac verán que el puerto por defecto de Mamp es 8888***

### ¿Todo bien hasta aquí? Continuemos...
- Vé a al repositorio de [AxiomaFrame](https://github.com/segundogaldames/axiomaframe/ "axiomaframe") y en el botón **Code** podrás acceder a dos formas básicas de descarga: hacer un clon del repositorio o descargarlo como Zip.
- Si vas a clonar, entonces debes hacer lo siguiente:
	- Abre la linea de comandos que te provee Git (se instala junto con Git en Windows)
	- Dentro de la linea de comandos navega hasta la carpeta htdocs. En esta carpeta se alojan los proyectos web que corren en Apache (el nombre de la carpeta htdocs es el que usa Xampp para alojar proyectos. En el caso de WampServer es www).
	- Dentro de la carpeta htdocs escribe el comando:
***git clone https://github.com/segundogaldames/axiomaframe.git***.

	- Se comenzará a descargar todo el repositorio. Al finalizar, tendrás una carpeta llamada axiomaframe, dentro de la carpeta htdocs.
	- Renombra la carpeta axiomaframe con otro nombre. El que mejor describa el proyecto que deseas iniciar.
	- Prueba la aplicación ingresando la expresion localhost/nombre_proyecto, en donde <nombre de proyecto> es el nombre con el cual renombraste la carpeta axiomaframe. Recuerda que los nombres de las carpetas para las aplicaciones web no deben tener espacios entre palabras. Si todo anda bien, verás la pantalla de inicio de ***AxiomaFrame*** con las opciones y textos de inicio.

En la parte final del texto de bienvenida de la página principal verás dos enlaces: Más Información y Documentación. Estos son enlaces directos para ayudarte a encontrar la información que requieras de ***AxiomaFrame***.

A continuación te invitamos a conocer la estructura del directorio de ***AxiomaFrame***, [pinchando aquí ](https://github.com/segundogaldames/axiomaframe/blob/main/DIRECTORY.md "pinchando aquí ")
