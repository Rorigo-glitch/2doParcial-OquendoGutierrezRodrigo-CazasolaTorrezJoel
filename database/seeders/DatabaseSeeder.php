<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@tienda.com'],
            ['name' => 'Administrador', 'password' => 'admin12345'],
        );

        $datos = [
            'Bebidas' => [['Coca-Cola 2L', 'Gaseosa familiar', 12.50, 40], ['Agua Vital 600ml', 'Agua sin gas', 3.00, 3]],
            'Abarrotes' => [['Arroz 1kg', 'Arroz grano largo', 9.00, 25], ['Aceite 1L', 'Aceite de girasol', 16.50, 4]],
            'Lácteos' => [['Leche PIL 1L', 'Leche entera', 7.50, 30], ['Queso criollo', 'Queso fresco por unidad', 18.00, 12]],
            'Limpieza' => [['Detergente 1kg', 'Detergente en polvo', 21.00, 15], ['Lavandina 1L', 'Cloro', 6.00, 2]],
        ];

        foreach ($datos as $nombre => $productos) {
            $categoria = Categoria::firstOrCreate(['nombre' => $nombre]);
            foreach ($productos as [$n, $d, $precio, $stock]) {
                Producto::firstOrCreate(
                    ['nombre' => $n],
                    ['descripcion' => $d, 'precio' => $precio, 'stock' => $stock, 'categoria_id' => $categoria->id],
                );
            }
        }
    }
}
