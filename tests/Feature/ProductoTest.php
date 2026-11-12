<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    private function usuario(): User
    {
        return User::create(['name' => 'Ana', 'email' => 'a@a.com', 'password' => 'clave-segura-123']);
    }

    private function datos(array $extra = []): array
    {
        $c = Categoria::firstOrCreate(['nombre' => 'Bebidas']);

        return array_merge(['nombre' => 'Jugo', 'descripcion' => '', 'precio' => 5, 'stock' => 10, 'categoria_id' => $c->id], $extra);
    }

    public function test_sin_sesion_redirige_al_login(): void
    {
        $this->get('/productos')->assertRedirect('/login');
    }

    public function test_rechaza_precio_y_stock_negativos(): void
    {
        $this->actingAs($this->usuario())
            ->post('/productos', $this->datos(['precio' => -1, 'stock' => -5]))
            ->assertSessionHasErrors(['precio', 'stock']);

        $this->assertDatabaseCount('productos', 0);
    }

    public function test_crea_producto_valido(): void
    {
        $this->actingAs($this->usuario())
            ->post('/productos', $this->datos())
            ->assertRedirect('/productos');

        $this->assertDatabaseCount('productos', 1);
    }

    public function test_ajuste_no_deja_stock_negativo(): void
    {
        $p = Producto::create($this->datos(['nombre' => 'X', 'stock' => 2]));

        $this->actingAs($this->usuario())->patch("/productos/{$p->id}/stock", ['cantidad' => -5]);

        $this->assertSame(2, $p->fresh()->stock);
    }
}
