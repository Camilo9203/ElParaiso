<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Folder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folders')->insert([
            'id' => '1026279129',
            'name' => 'Camilo Ríos',
            'path' => '/1026279129',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Folder::factory()->times(99)->create();
    }
}
