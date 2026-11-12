# 🏪 Inventario de Tienda — Segundo parcial (Desarrollo Web Backend)

Mini sistema de inventario para un negocio local. **Framework backend: Laravel** (MVC) con interfaz web
hecha con vistas Blade, servidas por el mismo Laravel. Base de datos: SQLite por defecto (MySQL opcional vía `.env`).

**Recurso principal (CRUD):** Productos — nombre, descripción, precio, stock y categoría.

## Requisitos
- PHP 8.2+ (extensiones: `pdo_sqlite`, `mbstring`, `openssl`, `ctype`, `tokenizer`, `xml`)
- Composer
- Git

## Cómo arrancar
```bash
git clone <URL-DEL-REPO>
cd inventario-laravel

composer install
cp .env.example .env            # Windows: copy .env.example .env
php artisan key:generate

php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate --seed      # crea tablas + usuario admin + productos de prueba
php artisan serve
```
Abrir http://127.0.0.1:8000 — usuario de prueba: `admin@tienda.com` / `admin12345`
(o crea tu cuenta en *Registrarse*).

Pruebas automáticas: `php artisan test`

**Usar MySQL:** crea la base `inventario_tienda`, en `.env` pon `DB_CONNECTION=mysql` y completa
`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`; luego `php artisan migrate --seed`.

## Los 6 mínimos: dónde está cada uno
| # | Mínimo | Dónde |
|---|--------|-------|
| 1 | Arquitectura (MVC) | `routes/web.php` → `app/Http/Controllers/` → `app/Models/` → `resources/views/`; tablas en `database/migrations/` |
| 2 | CRUD completo | `ProductoController` (index, create, store, show, edit, update, destroy) + `Route::resource('productos', ...)` |
| 3 | Autenticación | `AuthController` (registro, login, logout); clave hasheada con bcrypt (cast `hashed` en `app/Models/User.php`) |
| 4 | Middleware | `Route::middleware('auth')` y `'guest'` en `routes/web.php` |
| 5 | Validación | `app/Http/Requests/ProductoRequest.php` (precio y stock ≥ 0, nombre único) + validación en `AuthController` y `ajustarStock` |
| 6 | Variables de entorno | `.env` (no se sube), `.env.example` (sí), `.gitignore`; Laravel las lee con `env()` en `config/` |

## Extras
Panel con métricas · búsqueda y filtro por categoría (scope `filtrar` en `Producto`) · alerta de stock bajo ·
ajuste rápido de stock (+/−) · exportar a CSV · gestión de categorías · pruebas automáticas.

## Estructura
```
├── app/Http/Controllers/   # Auth, Panel, Producto, Categoria
├── app/Http/Requests/      # ProductoRequest (reglas de validación)
├── app/Models/             # User, Producto, Categoria
├── database/migrations/    # estructura de tablas
├── database/seeders/       # datos de prueba
├── resources/views/        # vistas Blade
├── routes/web.php          # qué URL llama a qué
├── tests/Feature/          # pruebas
├── .env.example            # variables sin secretos
└── composer.json
```
