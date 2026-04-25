# Vibly — SaaS Website Builder

Generador de sitios web multi-sector para negocios locales. Construido con Laravel 13 + PHP 8.3, gestionado con DDEV.

## Requisitos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (o Docker Engine en Linux)
- [DDEV](https://ddev.readthedocs.io/en/stable/#installation) v1.23+

No necesitas PHP, Composer ni Node instalados localmente. DDEV los provee dentro del contenedor.

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/vickrepe/webs.git
cd webs
```

### 2. Configurar el entorno

```bash
cp .env.example .env
```

Edita `.env` y ajusta los valores necesarios (ver sección [Variables de entorno](#variables-de-entorno)).

### 3. Arrancar DDEV

```bash
ddev start
```

Esto levanta los contenedores (web + base de datos MariaDB 11.8) y configura el dominio local `https://vibly.ddev.site`.

### 4. Instalar dependencias

```bash
ddev composer install
```

### 5. Generar clave de aplicación

```bash
ddev exec php artisan key:generate
```

### 6. Ejecutar migraciones y seeders

```bash
ddev exec php artisan migrate --seed
```

Esto crea todas las tablas y carga el catálogo de sectores y variantes (peluquería, comida, servicios, ropa, etc.).

### 7. Crear enlace de storage

```bash
ddev exec php artisan storage:link
```

### 8. Abrir en el navegador

```
https://vibly.ddev.site
```

El usuario de prueba creado por el seeder es:
- **Email:** `test@example.com`
- **Password:** `password`

---

## Variables de entorno

Las variables críticas a configurar en `.env`:

| Variable | Descripción | Obligatoria |
|---|---|---|
| `APP_KEY` | Generada con `artisan key:generate` | Sí |
| `APP_URL` | URL local, normalmente `https://vibly.ddev.site` | Sí |
| `DB_CONNECTION` | En local con DDEV usar `mysql` | Sí |
| `DB_HOST` | `db` (nombre del servicio DDEV) | Sí |
| `DB_DATABASE` | `db` | Sí |
| `DB_USERNAME` | `db` | Sí |
| `DB_PASSWORD` | `db` | Sí |
| `GOOGLE_CLIENT_ID` | OAuth2 de Google Cloud Console | Solo para reservas |
| `GOOGLE_CLIENT_SECRET` | OAuth2 de Google Cloud Console | Solo para reservas |

### `.env` recomendado para DDEV

```dotenv
APP_NAME=Vibly
APP_ENV=local
APP_KEY=             # se genera en el paso 5
APP_DEBUG=true
APP_URL=https://vibly.ddev.site

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=db
DB_PASSWORD=db

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local

MAIL_MAILER=log

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI="${APP_URL}/dashboard/google/callback"
```

---

## Comandos habituales

Todos los comandos PHP/Artisan/Composer deben ejecutarse con el prefijo `ddev exec`:

```bash
# Artisan
ddev exec php artisan migrate
ddev exec php artisan db:seed --class=NombreDelSeeder
ddev exec php artisan tinker

# Composer
ddev composer require paquete/nombre

# Ver logs
ddev logs

# Acceder al contenedor
ddev ssh

# Parar el entorno
ddev stop

# Destruir contenedores (no borra archivos)
ddev delete
```

---

## Estructura del proyecto

```
app/
  Http/Controllers/     # Controladores (Builder, Onboarding, Admin...)
  Models/               # Site, SiteSection, CatalogSector, CatalogVariant...
  Services/             # SiteService, CatalogService, GoogleCalendarService
config/
  templates/            # Definición de secciones por sector (food.php, barbershop.php...)
  catalog.php           # Mapa de sectores y variantes
  plans.php             # Límites por plan (free/basic/pro)
database/
  migrations/
  seeders/              # CatalogSeeder, UpdateVariantLayoutsSeeder...
resources/views/
  themes/               # Vistas por sector: barbershop, food, salon, clothing, services_local, influencer
  builder/              # UI del editor visual
  admin/                # Panel de administración
```

---

## Integración con Google Calendar

Para habilitar la funcionalidad de reservas con sincronización a Google Calendar:

1. Crea un proyecto en [Google Cloud Console](https://console.cloud.google.com/)
2. Activa la **Google Calendar API**
3. Crea credenciales OAuth 2.0 (tipo "Aplicación web")
4. Añade como URI de redirección autorizado: `https://vibly.ddev.site/dashboard/google/callback`
5. Copia el Client ID y Secret en `.env`

---

## Usuario superadmin

Para acceder al panel de administración (`/admin`), el usuario debe tener el rol de superadmin. Puedes asignarlo desde tinker:

```bash
ddev exec php artisan tinker --execute="App\Models\User::where('email', 'test@example.com')->update(['is_superadmin' => true]);"
```
