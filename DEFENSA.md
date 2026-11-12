# Guion de defensa (≈20 min) — repártanse los momentos entre los dos

## Antes de entrar
- `composer install`, migraciones y seed hechos; `php artisan serve` corriendo.
- Editor abierto con el proyecto. Una sesión iniciada y otra en incógnito (para mostrar el bloqueo sin sesión).

## Parte A — Features (hablar de lo que logra la persona, no de los clics)
1. **Cuentas:** "El dueño crea su cuenta; sin sesión no se puede ver nada." (abrir `/productos` en incógnito → manda al login)
2. **Panel:** "Al entrar ve cuántos productos hay, el valor del inventario y cuántos están por agotarse."
3. **Buscar y filtrar:** "Encuentra un producto por nombre, por categoría o solo los de stock bajo."
4. **Stock rápido:** "Al vender o reponer ajusta el stock con +/−; no deja bajar de cero."
5. **Datos que se cuidan solos:** guardar precio `-5` o un nombre repetido → el backend avisa y no guarda.
6. **Exportar:** "La lista filtrada se descarga como CSV para Excel."

## Parte B — Backend (señalar archivos en el editor)
| Mostrar | Archivo |
|---|---|
| Arquitectura: ruta → controlador → modelo → vista | `routes/web.php`, `ProductoController`, `Producto`, `resources/views/productos/` |
| CRUD | `Route::resource('productos', ...)` y los 7 métodos del controlador |
| Autenticación, clave hasheada | `AuthController`, cast `hashed` en `User`, columna `password` en la tabla `users` |
| Middleware | `Route::middleware('auth')` en `routes/web.php` |
| Validación | `ProductoRequest::rules()` |
| Entorno | `.env.example`, `.gitignore`, `config/database.php` (`env()`) |
| Extras | `scopeFiltrar` en `Producto`, `ajustarStock`, `exportar`, `tests/Feature/ProductoTest.php` |

Cierre: "La interfaz son vistas Blade servidas por el mismo Laravel."

## Preguntas probables
- **¿Por qué Laravel?** Trae rutas, ORM (Eloquent), validación, middleware y migraciones integrados.
- **¿Qué es MVC?** Modelo (datos), Vista (HTML/Blade), Controlador (lógica que une los dos).
- **¿Qué hace una migración?** Describe cambios de tablas; `migrate` las aplica a la base.
- **¿Cómo se guarda la clave?** Hasheada con bcrypt; nunca en texto plano.
- **¿Para qué `@csrf`?** Protege los formularios POST contra envíos falsos desde otros sitios.
- **¿Por qué validar en el backend si el navegador ya valida?** La interfaz se puede saltar; el backend es la última barrera.
- **¿Qué hace `restrictOnDelete` en `categoria_id`?** Impide borrar una categoría que aún tiene productos.
- **¿Qué hace `FormRequest`?** Valida antes de que se ejecute el método del controlador.
