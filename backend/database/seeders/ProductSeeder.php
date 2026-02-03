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
        // Hosting Products
        Product::create([
            'name' => 'Hosting Básico',
            'category' => 'Hosting',
            'price' => 4.99,
            'billing_cycle' => 'Monthly',
            'features_specs' => [
                'storage' => '10 GB SSD',
                'bandwidth' => 'Ilimitado',
                'websites' => 1,
                'email_accounts' => 5,
                'databases' => 1,
                'ssl' => true,
                'backup' => 'Semanal'
            ]
        ]);

        Product::create([
            'name' => 'Hosting Profesional',
            'category' => 'Hosting',
            'price' => 9.99,
            'billing_cycle' => 'Monthly',
            'features_specs' => [
                'storage' => '50 GB SSD',
                'bandwidth' => 'Ilimitado',
                'websites' => 5,
                'email_accounts' => 20,
                'databases' => 5,
                'ssl' => true,
                'backup' => 'Diario',
                'cdn' => true
            ]
        ]);

        Product::create([
            'name' => 'Hosting Premium',
            'category' => 'Hosting',
            'price' => 19.99,
            'billing_cycle' => 'Monthly',
            'features_specs' => [
                'storage' => '200 GB SSD',
                'bandwidth' => 'Ilimitado',
                'websites' => 'Ilimitado',
                'email_accounts' => 'Ilimitado',
                'databases' => 'Ilimitado',
                'ssl' => true,
                'backup' => 'Diario',
                'cdn' => true,
                'priority_support' => true
            ]
        ]);

        // VPS Products
        Product::create([
            'name' => 'VPS Básico',
            'category' => 'VPS',
            'price' => 29.99,
            'billing_cycle' => 'Monthly',
            'features_specs' => [
                'cpu' => '2 vCPU',
                'ram' => '4 GB',
                'storage' => '80 GB SSD',
                'bandwidth' => '3 TB',
                'ip_addresses' => 1,
                'root_access' => true
            ]
        ]);

        // Domain Products
        Product::create([
            'name' => 'Dominio .com',
            'category' => 'Domain',
            'price' => 14.99,
            'billing_cycle' => 'Yearly',
            'features_specs' => [
                'extension' => '.com',
                'dns_management' => true,
                'privacy_protection' => true,
                'email_forwarding' => true
            ]
        ]);

        // SSL Products
        Product::create([
            'name' => 'SSL Básico',
            'category' => 'SSL',
            'price' => 9.99,
            'billing_cycle' => 'Yearly',
            'features_specs' => [
                'type' => 'Domain Validated',
                'encryption' => '256-bit',
                'warranty' => '$10,000',
                'validation' => 'Automática'
            ]
        ]);
    }
}
