<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin
        User::create([
            'name' => 'Administrador',
            'first_name' => 'Admin',
            'last_name' => 'Sistema',
            'email' => 'admin@ecommerce.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'email_verified_at' => now()
        ]);

        // Crear usuario regular de prueba
        User::create([
            'name' => 'Usuario Test',
            'first_name' => 'Usuario',
            'last_name' => 'Prueba',
            'email' => 'user@ecommerce.com',
            'password' => Hash::make('user123'),
            'is_admin' => false,
            'email_verified_at' => now()
        ]);
    }
}
