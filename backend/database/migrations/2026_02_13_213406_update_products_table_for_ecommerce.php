<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Agregar campos para e-commerce
            $table->text('description')->nullable()->after('name');
            $table->string('image_url')->nullable()->after('description');
            $table->integer('stock')->default(0)->after('price');
            $table->decimal('discount_percentage', 5, 2)->default(0)->after('stock');
            $table->integer('sales_count')->default(0)->after('discount_percentage');
            $table->boolean('is_active')->default(true)->after('sales_count');
            $table->string('author')->nullable()->after('is_active');
            $table->boolean('is_featured')->default(false)->after('author');
            
            // Modificar campos existentes
            $table->dropColumn('billing_cycle');
            $table->dropColumn('features_specs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revertir cambios
            $table->dropColumn([
                'description',
                'image_url', 
                'stock',
                'discount_percentage',
                'sales_count',
                'is_active',
                'author',
                'is_featured'
            ]);
            
            $table->string('billing_cycle');
            $table->json('features_specs')->nullable();
        });
    }
};
