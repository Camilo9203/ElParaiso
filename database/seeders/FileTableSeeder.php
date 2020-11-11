<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\File;
use App\Models\Folder;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::factory()->times(10)->has(Folder::factory()->count(3))->has(Category::factory()->count(1))->create();
    }
}
