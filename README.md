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

Necesitas **una** de estas dos opciones:

- **Opción local:** PHP >= 8.2 (con las extensiones habituales de Laravel),
  Composer 2, Node.js >= 18 con npm y MySQL 8 (o MariaDB equivalente).
- **Opción Docker:** [Laradock](https://laradock.io) (trae nginx, PHP, MySQL,
  Composer y Node ya configurados). Ver sección
  [Puesta en marcha con Laradock](#puesta-en-marcha-con-laradock).

> El fichero `.env` **no** está en el repositorio (está en `.gitignore`). Al
> clonar tienes que crearlo con `cp .env.example .env`. Ese es siempre el primer
> paso, uses la opción que uses.

## Instalación (PHP local)

Usa esta vía si tienes PHP, MySQL y Node instalados directamente en tu equipo.

```bash
# 1. Instalar dependencias de PHP
composer install

# 2. Copiar el fichero de entorno y ajustarlo
cp .env.example .env
#   Edita .env y configura DB_DATABASE, DB_USERNAME y DB_PASSWORD.
#   Con PHP local, deja DB_HOST=127.0.0.1.
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

## Puesta en marcha con Laradock

[Laradock](https://laradock.io) levanta nginx, PHP-FPM, MySQL, Composer y Node
en contenedores Docker, así no necesitas instalar nada de eso en tu equipo.

> **Idea clave:** con Laradock ejecutas los comandos (`composer`, `php artisan`,
> `npm`) **dentro** del contenedor `workspace`, no en tu Windows. Y desde dentro
> de los contenedores, MySQL **no** es `127.0.0.1`: es el host `mysql` (el nombre
> del servicio en Docker). Cambiar esto es el error nº 1 de quien empieza.

### 1. Colocar Laradock junto al proyecto

Una estructura típica es tener Laradock como carpeta hermana del proyecto:

```
proyectos/
├── laradock/            <-- clonado de https://github.com/laradock/laradock
└── marcapersonalFP/     <-- este repositorio
```

```bash
git clone https://github.com/laradock/laradock.git
cd laradock
cp env-example .env
```

En el `.env` **de Laradock** revisa/ajusta (suelen venir así por defecto):

```env
# Apunta Laradock a la carpeta del proyecto (ruta relativa a laradock/)
APP_CODE_PATH_HOST=../marcapersonalFP/

# MySQL
MYSQL_VERSION=8.0
MYSQL_DATABASE=marcapersonalfp
MYSQL_USER=marca
MYSQL_PASSWORD=secret
MYSQL_ROOT_PASSWORD=root
MYSQL_PORT=3306
```

### 2. Levantar los contenedores

```bash
# Desde la carpeta laradock/
docker-compose up -d nginx mysql
```

Esto arranca nginx, PHP-FPM, MySQL y el `workspace`.

### 3. Configurar el `.env` del proyecto Laravel

Entra al contenedor `workspace` (ahí tienes PHP, Composer y Node):

```bash
docker-compose exec workspace bash
```

Ya **dentro del contenedor**, en la carpeta del proyecto:

```bash
cp .env.example .env
```

Y edita el `.env` **de Laravel** con la configuración de base de datos de Docker:

```env
DB_CONNECTION=mysql
DB_HOST=mysql            # <-- NOMBRE del servicio Docker, NO 127.0.0.1
DB_PORT=3306
DB_DATABASE=marcapersonalfp
DB_USERNAME=root         # 'root' usa MYSQL_ROOT_PASSWORD; o usa MYSQL_USER/MYSQL_PASSWORD
DB_PASSWORD=root
```

> Las credenciales deben **coincidir** con las del `.env` de Laradock. Si la base
> de datos `marcapersonalfp` no se creó sola (`MYSQL_DATABASE`), créala a mano:
> `docker-compose exec mysql mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS marcapersonalfp;"`

### 4. Instalar y arrancar (dentro de `workspace`)

```bash
composer install
php artisan key:generate
php artisan migrate
npm install
npm run build
```

Con nginx levantado, la aplicación está en **<http://localhost>** (puerto 80).
No hace falta `php artisan serve`: de eso se encarga nginx.

### 5. (Opcional) Dominio bonito tipo `marcapersonalfp.test`

Solo si en lugar de `http://localhost` quieres `http://marcapersonalfp.test`.
Es puramente cosmético; puedes saltarte este paso.

1. **Editar el fichero `hosts` como Administrador** y añadir una línea:
   - Windows: `C:\Windows\System32\drivers\etc\hosts`
   - Linux/macOS: `/etc/hosts`
   ```
   127.0.0.1   marcapersonalfp.test
   ```
2. **Configurar nginx en Laradock.** Copia el ejemplo y crea un sitio:
   ```bash
   # En laradock/nginx/sites/
   cp laravel.conf.example marcapersonalfp.conf
   ```
   Edita `marcapersonalfp.conf` y ajusta:
   ```nginx
   server_name marcapersonalfp.test;
   root /var/www/marcapersonalFP/public;
   ```
3. **Reiniciar nginx:**
   ```bash
   docker-compose restart nginx
   ```
4. **Ajustar el `.env` de Laravel:**
   ```env
   APP_URL=http://marcapersonalfp.test
   ```

Ahora la app responde en <http://marcapersonalfp.test>.

### Comandos útiles del día a día

```bash
docker-compose up -d nginx mysql      # arrancar
docker-compose exec workspace bash    # entrar a PHP/Composer/Node
docker-compose down                   # parar y eliminar contenedores
```

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
