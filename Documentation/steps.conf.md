PASOS EXAMEN SERVIDOR
#paginas de interes 
https://github.com/albsierra/marcapersonalFP_REA/tree/master/documentos/0613_Servidor
https://2daw-carlosiii.github.io/marcapersonalFP_REA/documentos/0613_Servidor/

COMANDOS
Comando	Para qué sirve
php artisan make:model Modelo	Crea un modelo Eloquent
php artisan make:controller NombreController	Crea un controlador
php artisan make:migration create_tabla_table	Crea una migración
php artisan make:seeder NombreSeeder	Crea un seeder
php artisan make:factory NombreFactory	Crea una factory
php artisan make:request NombreRequest	Crea un Form Request para validaciones
php artisan make:middleware NombreMiddleware	Crea un middleware
php artisan make:resource NombreResource	Crea un API Resource
php artisan make:rule NombreRule	Crea una regla de validación personalizada
php artisan make:policy NombrePolicy	Crea una policy de autorización
php artisan make:observer NombreObserver	Crea un observer para modelos
php artisan make:command NombreCommand	Crea un comando Artisan propio
php artisan make:event NombreEvent	Crea un evento
php artisan make:listener NombreListener	Crea un listener
php artisan make:job NombreJob	Crea un job para colas
php artisan make:mail NombreMail	Crea una clase de email
php artisan make:notification NombreNotification	Crea una notificación
php artisan make:exception NombreException	Crea una excepción personalizada
php artisan make:provider NombreServiceProvider	Crea un service provider
php artisan make:component NombreComponent	Crea un componente Blade
php artisan make:cast NombreCast	Crea un cast personalizado de Eloquent
php artisan make:channel NombreChannel	Crea un canal de broadcasting
php artisan make:test NombreTest	Crea un test
php artisan make:enum NombreEnum	Crea un enum
php artisan make:class NombreClase	Crea una clase normal
php artisan make:interface NombreInterface	Crea una interfaz
php artisan make:trait NombreTrait	Crea un trait
php artisan make:scope NombreScope	Crea un scope de Eloquent
php artisan make:view nombre-vista	Crea una vista Blade, si tu versión lo incluye


php artisan route:list --path=cursos



php artisan make:model Producto -mcr

Esto crea normalmente:

Modelo + migration + controller resource

Opciones típicas de make:model:

Opción	Significado
-m	Crea migración
-c	Crea controlador
-r	Controlador tipo resource
-f	Crea factory
-s	Crea seeder
-a	Crea varios elementos asociados: migration, factory, seeder, policy, controller, etc.

Ejemplos rápidos:

php artisan make:model Libro -m
php artisan make:controller LibroController
php artisan make:controller LibroController --resource
php artisan make:migration create_libros_table
php artisan make:seeder LibroSeeder
php artisan make:factory LibroFactory
php artisan make:request StoreLibroRequest
php artisan make:middleware EsAdmin
php artisan make:resource LibroResource

## 1) Verificar herramientas base

VSC:
autoguardado
extensiones better comment next
composer
material icon theme
laravel extra intephense
php intelliphense
laravel blade formater

debian:
mousepad




## 2) Primeras instalaciones y configuraciones
git clone (en laradoc)
git remote add upstream (repo profe)
git config --global user.name 
git config --global user.email  



3 configuraciones nuevo repo:
sudo mousepad etc/hosts 
127.0.0.1 web.test




4 en  ~/Documentos/laravel/laradock
 docker compose up -d nginx mariadb php-fpm phpmyadmin workspace
/Documentos/laravel/laradock/nginx/sites/
 listen 80;
    listen [::]:80;


    server_name olimpiadas.test;
    root /var/www/olimpiadasC3/public;
    index index.php index.html index.htm
docker compose restart nginx        

## 5) En carpeta de proyecto

composer install
php artisan key:generate
Configurar en .env:
 DB_CONNECTION=mysql
 DB_HOST=mariadb
 DB_PORT=3306
 DB_DATABASE=marcapersonalfp
 DB_USERNAME=marcapersonalfp
 DB_PASSWORD=marcapersonalfp




6. Crear bbdd:
En http://127.0.0.1:8081 
Crear nuevo usuario con nueva bbdd

7 subir tablas y tados a BBDD
php artisan migrate
php artisan db:seed
8 linkear la carpeta storage
docker compose exec workspace php artisan storage:link

o tambien 
cd /home/alumno/Documentos/laravel/laradock
docker compose exec workspace bash


cd ~/Documentos/laravel/laradock
docker compose exec workspace bash -lc "cd /var/www/marcapersonalFP25_26 && php artisan storage:link"






