# Api desarrolada en laravel V-8

A continuación, tenemos una secuencia de comnados a utilizar antes de subir el server de la api

# Generar .env después de clonar repositorio

```
cp .env.example .env

php artisan key:generate

```

# Instalar dependencias antes de correr el proyecto

```
composer install

```

# Crear base de datos

```
Se debe de configuar la conexion a la base de datos en el archivo .env

```

# Ejecutar las migracioones

```
php artisan migrate

```

# Crear usario para ingreso desde la plataforma web

```
php artisan db:seed --class=UserSeeder

```

# Subir serve api

```
php artisan server --port==2020

Nota si se cambia el puerto de la api se debe de cambiar en el archvo .env de la plataforma web la variable API_REST = http://127.0.0.1:2020/api

```
