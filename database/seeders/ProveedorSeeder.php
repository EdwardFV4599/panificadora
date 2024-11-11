<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Proveedores para Harina de Trigo
        Proveedor::create([
            'nombre' => 'Proveedor de Harinas S.A.',
            'ruc' => '20212345678',
            'correo' => 'contacto@harinas.com',
            'telefono' => '012345678',
            'direccion' => 'Av. Principal 123, Lima',
            'descripcion' => 'Proveedor de harinas para panadería y repostería',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Distribuidora Molino',
            'ruc' => '20345678901',
            'correo' => 'ventas@molino.com',
            'telefono' => '014567891',
            'direccion' => 'Av. Las Molinas 456, Lima',
            'descripcion' => 'Harinas y productos de molienda',
            'estado' => 1,
        ]);

        // Proveedores para Azúcar
        Proveedor::create([
            'nombre' => 'Azúcar del Norte',
            'ruc' => '20398765432',
            'correo' => 'info@azucarnorte.com',
            'telefono' => '019876543',
            'direccion' => 'Calle Dulce 101, Trujillo',
            'descripcion' => 'Proveedor de azúcar granulada y refinada',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Cacao y Azúcar Perú',
            'ruc' => '20456789101',
            'correo' => 'info@cacaoyazucar.com',
            'telefono' => '015678910',
            'direccion' => 'Calle Comercio 789, Cusco',
            'descripcion' => 'Especializados en cacao y azúcar para repostería',
            'estado' => 1,
        ]);

        // Proveedores para Chocolate
        Proveedor::create([
            'nombre' => 'Cacao Fino S.A.',
            'ruc' => '20567891234',
            'correo' => 'ventas@cacaofino.com',
            'telefono' => '017891234',
            'direccion' => 'Av. Cacao 123, Lima',
            'descripcion' => 'Distribuidor de cacao y chocolate para repostería',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Chocolates del Sur',
            'ruc' => '20678912345',
            'correo' => 'chocolates@delsur.com',
            'telefono' => '018912345',
            'direccion' => 'Jr. Cacao 987, Arequipa',
            'descripcion' => 'Proveedor de chocolate y productos derivados',
            'estado' => 1,
        ]);

        // Proveedores para Leche y Derivados
        Proveedor::create([
            'nombre' => 'Lácteos del Sur S.A.C.',
            'ruc' => '20789123456',
            'correo' => 'contacto@lacteos.com',
            'telefono' => '0123456789',
            'direccion' => 'Jr. Secundario 456, Arequipa',
            'descripcion' => 'Proveedor de leche, mantequilla y crema de leche',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Distribuidora Láctea',
            'ruc' => '20891234567',
            'correo' => 'ventas@lactea.com',
            'telefono' => '0112345678',
            'direccion' => 'Av. Láctea 321, Cusco',
            'descripcion' => 'Proveedor de productos lácteos para repostería',
            'estado' => 1,
        ]);

        // Proveedores para Frutas y Verduras
        Proveedor::create([
            'nombre' => 'Distribuidora Frutas y Verduras',
            'ruc' => '20912345678',
            'correo' => 'contacto@frutasyverduras.com',
            'telefono' => '016789123',
            'direccion' => 'Av. Los Frutales 321, Lima',
            'descripcion' => 'Distribuidor de frutas frescas',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Frutas del Campo',
            'ruc' => '21023456789',
            'correo' => 'frutas@delcampo.com',
            'telefono' => '013456789',
            'direccion' => 'Jr. Del Campo 654, Piura',
            'descripcion' => 'Proveedor de frutas y verduras para repostería',
            'estado' => 1,
        ]);

        // Proveedores adicionales para otros insumos
        Proveedor::create([
            'nombre' => 'Insumos Reposteros S.A.',
            'ruc' => '21134567890',
            'correo' => 'ventas@reposteros.com',
            'telefono' => '018765432',
            'direccion' => 'Av. Insumos 555, Lima',
            'descripcion' => 'Proveedores de insumos varios para repostería',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Ingredientes Perú',
            'ruc' => '21245678901',
            'correo' => 'contacto@ingredientesperu.com',
            'telefono' => '015678910',
            'direccion' => 'Calle Principal 789, Cusco',
            'descripcion' => 'Proveedor de ingredientes diversos',
            'estado' => 1,
        ]);
    }
}
