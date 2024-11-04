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
        Proveedor::create([
            'nombre' => 'Harinas del Valle S.A.',
            'ruc' => '20123456789',
            'correo' => 'contacto@harinasdelvalle.com',
            'telefono' => '987654321',
            'direccion' => 'Av. Los Industriales 456, Lima, Perú',
            'descripcion' => 'Proveedor de harina refinada e integral.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Azúcares y Derivados S.R.L.',
            'ruc' => '20134567890',
            'correo' => 'ventas@azucaresderivados.com',
            'telefono' => '912345678',
            'direccion' => 'Calle Los Dulces 789, Lima, Perú',
            'descripcion' => 'Especialistas en azúcar blanca, rubia y edulcorantes.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Sal y Especias Perú S.A.C.',
            'ruc' => '20145678901',
            'correo' => 'info@salyespeciasperu.com',
            'telefono' => '923456789',
            'direccion' => 'Jr. Condimentos 123, Arequipa, Perú',
            'descripcion' => 'Distribuidor de sal marina y diversas especias.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Aceites Finos E.I.R.L.',
            'ruc' => '20156789012',
            'correo' => 'contacto@aceitesfinos.com',
            'telefono' => '934567890',
            'direccion' => 'Av. Los Olivos 234, Trujillo, Perú',
            'descripcion' => 'Proveedor de aceites vegetales y margarinas.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Lácteos Andinos S.A.C.',
            'ruc' => '20167890123',
            'correo' => 'ventas@lacteosandinos.com',
            'telefono' => '945678901',
            'direccion' => 'Carretera Central Km 12, Cusco, Perú',
            'descripcion' => 'Distribuidor de leche y derivados lácteos.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Insumos Panaderos S.A.C.',
            'ruc' => '20178901234',
            'correo' => 'info@insumospanaderos.com',
            'telefono' => '956789012',
            'direccion' => 'Pasaje Panaderos 456, Lima, Perú',
            'descripcion' => 'Proveedores de ingredientes para la industria panadera.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Packaging Innovador E.I.R.L.',
            'ruc' => '20189012345',
            'correo' => 'ventas@packaginginnovador.com',
            'telefono' => '967890123',
            'direccion' => 'Av. Innovación 789, Chiclayo, Perú',
            'descripcion' => 'Proveedor de empaques sostenibles.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Fermentos Naturales S.R.L.',
            'ruc' => '20190123456',
            'correo' => 'ventas@fermentosnaturales.com',
            'telefono' => '978901234',
            'direccion' => 'Calle Natural 321, Piura, Perú',
            'descripcion' => 'Proveedores de levaduras y fermentos.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Emulsiones y Aromas S.A.',
            'ruc' => '20201234567',
            'correo' => 'contacto@emulsionesyaromas.com',
            'telefono' => '989012345',
            'direccion' => 'Av. Fragancias 987, Lima, Perú',
            'descripcion' => 'Especialistas en aromas y emulsiones para panadería.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Huevos del Campo E.I.R.L.',
            'ruc' => '20212345678',
            'correo' => 'ventas@huevosdelcampo.com',
            'telefono' => '990123456',
            'direccion' => 'Calle Gallinas 567, Huancayo, Perú',
            'descripcion' => 'Proveedor de huevos frescos de campo.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Frutas Secas Import S.A.',
            'ruc' => '20223456789',
            'correo' => 'info@frutassecasimport.com',
            'telefono' => '901234567',
            'direccion' => 'Av. Frutales 654, Lima, Perú',
            'descripcion' => 'Proveedor de frutas secas y nueces.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Chocolates y Cacao S.A.C.',
            'ruc' => '20234567890',
            'correo' => 'ventas@chocolatesycacao.com',
            'telefono' => '912345678',
            'direccion' => 'Jr. Cacaoteros 987, Cusco, Perú',
            'descripcion' => 'Distribuidor de chocolate y cacao.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Grasas y Margarinas del Sur S.A.',
            'ruc' => '20245678901',
            'correo' => 'contacto@grasasydelicias.com',
            'telefono' => '923456789',
            'direccion' => 'Av. Surco 345, Lima, Perú',
            'descripcion' => 'Proveedor de grasas vegetales.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Colorantes y Sabores S.A.C.',
            'ruc' => '20256789012',
            'correo' => 'ventas@colorantesysabores.com',
            'telefono' => '934567890',
            'direccion' => 'Calle Colores 654, Arequipa, Perú',
            'descripcion' => 'Distribuidor de colorantes y saborizantes.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Harinas del Norte E.I.R.L.',
            'ruc' => '20267890123',
            'correo' => 'info@harinasdelnorte.com',
            'telefono' => '945678901',
            'direccion' => 'Av. Norte 123, Piura, Perú',
            'descripcion' => 'Proveedor de harina de trigo y centeno.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Mieles y Jarabes S.A.C.',
            'ruc' => '20278901234',
            'correo' => 'ventas@mielesyjarabes.com',
            'telefono' => '956789012',
            'direccion' => 'Jr. Dulce 456, Cusco, Perú',
            'descripcion' => 'Distribuidor de miel natural y jarabes.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Sabor a Leche S.A.',
            'ruc' => '20289012345',
            'correo' => 'info@saboraleche.com',
            'telefono' => '967890123',
            'direccion' => 'Calle Lactosa 321, Huancavelica, Perú',
            'descripcion' => 'Proveedor de leche en polvo y condensada.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Panes y Masas S.A.C.',
            'ruc' => '20290123456',
            'correo' => 'contacto@panesymasas.com',
            'telefono' => '978901234',
            'direccion' => 'Av. Panadería 987, Lima, Perú',
            'descripcion' => 'Proveedor de premezclas y masas.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Cremas y Salsas E.I.R.L.',
            'ruc' => '20301234567',
            'correo' => 'info@cremasysalsas.com',
            'telefono' => '989012345',
            'direccion' => 'Jr. Cremoso 654, Lima, Perú',
            'descripcion' => 'Proveedores de cremas y salsas para la industria.',
            'estado' => 1,
        ]);

        Proveedor::create([
            'nombre' => 'Tecnologías Panaderas S.A.C.',
            'ruc' => '20312345678',
            'correo' => 'ventas@tecnologiaspanaderas.com',
            'telefono' => '990123456',
            'direccion' => 'Av. Innovación 345, Trujillo, Perú',
            'descripcion' => 'Distribuidor de maquinaria para panaderías.',
            'estado' => 1,
        ]);
    }
}
