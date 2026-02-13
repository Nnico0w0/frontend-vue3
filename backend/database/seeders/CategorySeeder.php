<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Novela Histórica',
                'description' => 'Novelas ambientadas en períodos históricos que recrean épocas pasadas',
                'image_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Drama',
                'description' => 'Historias emotivas y profundas que exploran la condición humana',
                'image_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Autoayuda',
                'description' => 'Libros para el crecimiento personal y el desarrollo de habilidades',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Fantasía',
                'description' => 'Mundos mágicos, aventuras épicas y criaturas fantásticas',
                'image_url' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Biografía',
                'description' => 'Historias de vidas extraordinarias y personajes influyentes',
                'image_url' => 'https://images.unsplash.com/photo-1503236823255-94609f598e71?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Clásicos',
                'description' => 'Las obras inmortales de la literatura universal',
                'image_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Misterio',
                'description' => 'Intrigas, enigmas y historias que mantienen en suspenso',
                'image_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Ciencia Ficción',
                'description' => 'Futuros imaginarios, tecnología avanzada y mundos alternativos',
                'image_url' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=300&h=200&fit=crop',
                'is_active' => true
            ],
            [
                'name' => 'Thriller',
                'description' => 'Historias de suspense y tensión que mantienen al lector en vilo',
                'image_url' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=300&h=200&fit=crop',
                'is_active' => true
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}
