<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Era',
                'description' => 'Una fascinante novela histórica que te transportará a épocas pasadas con una narrativa envolvente y personajes inolvidables.',
                'category' => 'Novela Histórica',
                'price' => 32.15,
                'image_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop',
                'stock' => 25,
                'discount_percentage' => 0,
                'sales_count' => 150,
                'is_active' => true,
                'author' => 'Arturo Pérez-Reverte',
                'is_featured' => true
            ],
            [
                'name' => 'Resistiré',
                'description' => 'Un relato emotivo sobre la resistencia y la esperanza en tiempos difíciles, una historia que toca el corazón.',
                'category' => 'Drama',
                'price' => 25.99,
                'image_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=400&fit=crop',
                'stock' => 18,
                'discount_percentage' => 15,
                'sales_count' => 203,
                'is_active' => true,
                'author' => 'Isabel Burdiel',
                'is_featured' => false
            ],
            [
                'name' => 'Ser feliz no es gratis',
                'description' => 'Una reflexión profunda sobre la búsqueda de la felicidad en el mundo moderno, con consejos prácticos y filosóficos.',
                'category' => 'Autoayuda',
                'price' => 32.15,
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=400&fit=crop',
                'stock' => 30,
                'discount_percentage' => 0,
                'sales_count' => 89,
                'is_active' => true,
                'author' => 'Rayuela Cordo',
                'is_featured' => false
            ],
            [
                'name' => 'El Espartano',
                'description' => 'Una épica aventura en la antigua Grecia llena de honor, batalla y heroísmo que te mantendrá en vilo.',
                'category' => 'Ficción Histórica',
                'price' => 32.15,
                'image_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop',
                'stock' => 22,
                'discount_percentage' => 0,
                'sales_count' => 267,
                'is_active' => true,
                'author' => 'Diego Moreno',
                'is_featured' => false
            ],
            [
                'name' => 'Ernesto Guevara, Che',
                'description' => 'Biografía completa del revolucionario más icónico del siglo XX, con detalles inéditos y análisis profundo.',
                'category' => 'Biografía',
                'price' => 32.15,
                'image_url' => 'https://images.unsplash.com/photo-1503236823255-94609f598e71?w=300&h=400&fit=crop',
                'stock' => 15,
                'discount_percentage' => 0,
                'sales_count' => 178,
                'is_active' => true,
                'author' => 'César Vidal',
                'is_featured' => false
            ],
            [
                'name' => 'Cien años de soledad',
                'description' => 'La obra maestra del realismo mágico latinoamericano que narra la historia de la familia Buendía.',
                'category' => 'Clásicos',
                'price' => 28.50,
                'image_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=400&fit=crop',
                'stock' => 40,
                'discount_percentage' => 0,
                'sales_count' => 445,
                'is_active' => true,
                'author' => 'Gabriel García Márquez',
                'is_featured' => true
            ],
            [
                'name' => 'La sombra del viento',
                'description' => 'Un misterio literario ambientado en la Barcelona de posguerra que combina amor, intriga y literatura.',
                'category' => 'Misterio',
                'price' => 24.95,
                'image_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop',
                'stock' => 35,
                'discount_percentage' => 20,
                'sales_count' => 312,
                'is_active' => true,
                'author' => 'Carlos Ruiz Zafón',
                'is_featured' => false
            ],
            [
                'name' => 'El nombre del viento',
                'description' => 'Primera entrega de la saga Crónica del Asesino de Reyes, una obra maestra de la fantasía épica.',
                'category' => 'Fantasía',
                'price' => 29.90,
                'image_url' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=400&fit=crop',
                'stock' => 28,
                'discount_percentage' => 0,
                'sales_count' => 189,
                'is_active' => true,
                'author' => 'Patrick Rothfuss',
                'is_featured' => false
            ],
            [
                'name' => '1984',
                'description' => 'La distopía más influyente del siglo XX que describe un mundo totalitario y opresivo.',
                'category' => 'Ciencia Ficción',
                'price' => 22.90,
                'image_url' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=300&h=400&fit=crop',
                'stock' => 50,
                'discount_percentage' => 25,
                'sales_count' => 523,
                'is_active' => true,
                'author' => 'George Orwell',
                'is_featured' => true
            ],
            [
                'name' => 'El código Da Vinci',
                'description' => 'Un thriller que combina arte, historia y misterio en una trama trepidante llena de enigmas.',
                'category' => 'Thriller',
                'price' => 26.75,
                'image_url' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=300&h=400&fit=crop',
                'stock' => 33,
                'discount_percentage' => 10,
                'sales_count' => 398,
                'is_active' => true,
                'author' => 'Dan Brown',
                'is_featured' => false
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}