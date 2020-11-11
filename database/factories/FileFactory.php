<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Category;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [ //TODO:Factory File
            'name' => $this->faker->name,
            'created' => $this->faker->date,
            'folder_id' => Folder::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
