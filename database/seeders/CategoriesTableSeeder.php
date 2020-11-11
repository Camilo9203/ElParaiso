<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => '1',
            'name' => 'Cedula',
            'description' => 'Fotocopias cedulas de ciudadania',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '2',
            'name' => 'Comprobante de ingreso abono',
            'description' => 'Comprobante de ingreso de abono, en orden crononologico',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '3',
            'name' => 'Orden de Pedido',
            'description' => 'Orden de Pedido',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '4',
            'name' => 'Comprobante de ingreso',
            'description' => 'Comprobante de ingreso (Cierre)',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '5',
            'name' => 'Contrato de compraventa o promesa',
            'description' => 'Comprobante de compraventa o promesa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '6',
            'name' => 'Otro si al contrato de compraventa',
            'description' => 'Otro si al contrato de compraventa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '7',
            'name' => 'Pagare',
            'description' => 'Pagare',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '8',
            'name' => 'Orden de servicio',
            'description' => 'Orden de servicio (Orden cronologico)',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '9',
            'name' => 'Carta de propiedad o paz y salvo',
            'description' => 'Carta de propiedad o paz y salvo (Orden Cronologico)',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'id' => '10',
            'name' => 'Otros',
            'description' => 'Otros documentos',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        //Category::factory()->times(9)->create();
    }
}
