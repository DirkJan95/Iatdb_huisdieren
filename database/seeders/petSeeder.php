<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    public function run()
    {
        Pet::create([
            'name' => 'Momo',
            'breed' => 'Cat',
            'date' => '2023-06-01',
            'how_long' => '1 dag',
            'cost' => 20,
            'age' => 3,
            'pet_picture' => "http://127.0.0.1:8000/images/Cat.png",
            'description' => 'Wauw! dit is echt een geweldige kat, 
            genaamd naar dat diertje van avater the last airbender. 
            Momo je kent hem wel. Kortom een top dier om op op tepassen.
            Wauw! dit is echt een geweldige kat, 
            genaamd naar dat diertje van avater the last airbender. 
            Momo je kent hem wel. Kortom een top dier om op op tepassen'
        ]);



        Pet::create([
            'name' => 'Coco',
            'breed' => 'Dog',
            'date' => '2023-05-26',
            'how_long' => '1 dag',
            'cost' => 15,
            'age' => 1,
            'pet_picture' => "http://127.0.0.1:8000/images/Dog.png",
        ]);

        Pet::create([
            'name' => 'Fluffy',
            'breed' => 'Other',
            'date' => '2023-05-24',
            'how_long' => '2 dagen',
            'cost' => 10,
            'age' => 6,
            'pet_picture' => "http://127.0.0.1:8000/images/Rabbit.png",
        ]);
    }
}
