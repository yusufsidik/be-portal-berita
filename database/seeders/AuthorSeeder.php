<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $jumlahData = 20;
        
        for ($i=0; $i < $jumlahData; $i++) { 
            Author::create([
                'name' => $faker->name(),
                'bio' => $faker->paragraph(),
                'avatar' => $faker->word().'.'.$faker->fileExtension()
            ]);
        }
    }
}
