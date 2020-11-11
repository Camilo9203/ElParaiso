<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Camilo Ríos',
            'email' => 'camilo@webroot.tech',
            'email_verified_at' => now(),
            'password' => Hash::make('1nv3st0rC'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::factory ()->times(50)->create();
    }
}
