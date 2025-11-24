<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Author;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');

        $authorIds = Author::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();
        $jumlahData = 5;

        for ($i = 0; $i < $jumlahData; $i++){
            News::create([
                'author_id' => $faker->randomElement($authorIds),
                'category_id' => $faker->randomElement($categoryIds),
                'title' => $faker->word(),
                'slug' => Str::of($faker->word())->slug('-'),
                'thumbnail' => $faker->word() . '.' .$faker->fileExtension(),
                'content' => $faker->paragraph(),
                'is_featured' => $faker->boolean()
            ]);
        }
    }
}
