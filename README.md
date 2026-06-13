# Marca Personal FP

Portfolio para el alumnado de Formación Profesional. La plataforma permite
gestionar **familias profesionales**, **ciclos formativos**, **estudiantes**,
**docentes** y **proyectos**, de modo que cada alumno/a pueda construir su marca
personal mostrando el trabajo realizado durante su ciclo.

> Estado: **esqueleto inicial**. En este primer commit solo está montado el
> andamiaje del proyecto (Laravel + Breeze + Sanctum + plantilla Dopetrope). El
> dominio (migraciones, modelos, controladores, seeders y API) llegará en
> commits posteriores.

## Stack

- **Laravel 12** (compatible con 11) · PHP 8.2+
- **MySQL** como base de datos
- **Laravel Breeze** (stack Blade) para la autenticación
- **Laravel Sanctum** para la capa API
- Plantilla **Dopetrope** de [HTML5 UP](https://html5up.net) para las vistas
  públicas (servida estáticamente desde `public/dopetrope`)

## Requisitos

- PHP >= 8.2 con las extensiones habituales de Laravel
- Composer 2
- Node.js >= 18 y npm
- MySQL 8 (o MariaDB equivalente)

## Instalación

```bash
# 1. Instalar dependencias de PHP
composer install

# 2. Copiar el fichero de entorno y ajustarlo
cp .env.example .env
#   Edita .env y configura DB_DATABASE, DB_USERNAME y DB_PASSWORD.
#   Crea la base de datos en MySQL (por defecto: marcapersonalfp).

# 3. Generar la clave de la aplicación
php artisan key:generate

# 4. Ejecutar las migraciones base (users, sessions, cache, jobs, tokens…)
php artisan migrate

# 5. Instalar y compilar los assets de Breeze
npm install
npm run build

# 6. Levantar el servidor de desarrollo
php artisan serve
```

La aplicación quedará disponible en <http://localhost:8000>.

## Rutas principales

| Ruta         | Descripción                                          |
| ------------ | ---------------------------------------------------- |
| `/`          | Página de inicio pública (layout Dopetrope), `home`  |
| `/register`  | Registro de usuarios (Breeze)                        |
| `/login`     | Inicio de sesión (Breeze)                            |
| `/dashboard` | Panel del usuario autenticado (protegido por `auth`) |

La capa API vive en `routes/api.php`, bajo el middleware `auth:sanctum`.

## Estructura preparada para próximos commits

```
app/Services/                 Lógica de negocio
app/Policies/                 Autorización
app/Http/Controllers/Api/     Controladores de la API
app/Http/Resources/           Recursos (transformación de respuestas API)
```

## Créditos

- Plantilla **Dopetrope** por [HTML5 UP](https://html5up.net) (@ajlkn),
  bajo licencia [Creative Commons Attribution 3.0](https://html5up.net/license).
