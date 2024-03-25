Instalación de php en tu ordenador

Hay dos formas
1. instalar el xampp y el ejecutable se encargara de instalar el php
2. ir a la pagina https://www.php.net/downloads se descarga la version que sea compatible con laravel y seguir la guia
para saber si esta instalado correctamente vamos al cmd y escribir php -version y te saldra la version que tienes en el ordenador en caso de que te salga un error la instalación no se ha hecho correctamente.

Instalación de composer para poder crear los proyectos de laravel

Ir a la pagina oficial https://getcomposer.org/download/ tambien hay  dos formas de instalarlo

1. A traves de comandos que sale en la pagina
2. descargar el instalador, seleccionar las opciones necesarias y instalar

Verificamos en el cmd si esta instalado poniendo composer

Finalmente con esto ya podriamos tener empezar a usar php o crear el proyecto en laravel

Instalación Laravel 10.0

composer create-project laravel/laravel:^10.0 laravel-vue-weather

Para la instalación necessitamos composer que se encarga se descarga el proyecto laravel 
en este caso y dejarlo configurado todo por defecto, si le especificamos ^10.0 es la version
que instalara y seguido el nombre del proyecto

Instalamos beezer para luego poder integrar vue

composer require laravel/breeze

Es recomendable que se use el --dev al principio eso solo lo instalara en modo desarrollo
en caso de que falle algo no afectara a la parte de produccion, cuando este okey se instala para produccion

Integramos Vue en el proyecto

php artisan breeze:install

Con la instruccion anterior tendremos un menu para poder elegir cual queremos instalar
si ya sabemos cual es podemos poner directamente de esta forma:

php artisan breeze:install vue

Despues de tener instalado vue en laravel con inertia, ya se puede empezar a programar
Poner lo siguiente para ejecutar el servidor
php artisan serve 

En otra terminal lo siguiente para que cargue el vite con lo que tengamos configurado
*Nota este comando solo es en modo desarrollo ya que se ha puesto dev, en produccion se tendria que
configurar

npm run dev