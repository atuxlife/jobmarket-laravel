## Descargar repositorio

Para descargar el repositorio se debe correr el comando

git clone git@github.com:atuxlife/jobmarket-laravel.git

## Instalación de dependencias

Una vez descargado el repositorio se procede a entrar en la carpeta principal con 

cd jobmarket-laravel

Luego se instalan las depandencias con el siguiente comando

composer install 

## Configuración del .env

Dentro del proyecto hay un archivo llamado .env.example, ese debe ser copiado y modificado con sus credenciales de conexión a la base de datos.

Para copiar el archivo hacemos lo siguiente

cp .env.example .env

Ya copiado cambiamos los siguientes parámetros por los utilizados para la conexión a su base de datos

DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=your_port
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password

## Ejecución de migraciones

Ya resueltas las dependencias se procede a inicializar la base de datos con el comando

php artisan migrate

### Seeders

Los seeders con los datos de prueba se corren de la siguiente manera

php artisan db:seed

### Puesta en marcha local

Dentro de la carpeta endpoints están unos archivos que le permitirán importar las peticiones hechas en las pruebas con Insomnia, se puede utilizar cualquier REST client para hacerlas.

Con los datos de prueba hay usuarios con perfil Admin y otros con perfil User. Se recomienda hacer una conexión con cualquier query browser para verificar estos usuarios. El username para el login es el correo electrónico de cualquier usuario y la contraseña es password.

Ya teniendo en cuenta los usuarios y contraseñas con los que se harán las pruebas, se debe iniciar el proyecto se utiliza el siguiente comando

php artisan serve

### Consideraciones finales

Los perfiles de User y Admin tienen las siguientes restricciones:

User:

- Registrar un usuario
- Puede hacer login
- Ver su perfil de usuario
- Listar todas las ofertas laborales
- Mostrar una oferta laboral
- Aplicar a una oferta laboral
- Hacer logout

Admin:

- Registrar un usuario
- Puede hacer login
- Ver su perfil de usuario
- Listar todas las ofertas laborales
- Mostrar una oferta laboral
- Crear una oferta laboral
- Editar una oferta laboral
- Listar las ofertas laborales y los postulantes a las mismas
- Hacer logout

Una vez hecho el login se debe copiar el valor del token generado como respuesta y utilizarlo como valor de token como autenticación Bearer token.
