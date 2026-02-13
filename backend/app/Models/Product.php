<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'image_url',
        'stock',
        'discount_percentage',
        'sales_count',
        'is_active',
        'author',
        'is_featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeTopSelling($query, $limit = 3)
    {
        return $query->orderBy('sales_count', 'desc')->limit($limit);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Relationships
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    // Business Methods
    public function getPriceFormatted(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getBillingCycleLabel(): string
    {
        return match($this->billing_cycle) {
            'Monthly' => '/mes',
            'Quarterly' => '/trimestre',  
            'Yearly' => '/año',
            default => ''
        };
    }

    public function getFullPriceLabel(): string
    {
        return $this->getPriceFormatted() . $this->getBillingCycleLabel();
    }

    public function isHostingProduct(): bool
    {
        return $this->category === 'Hosting';
    }

    // Factory method pattern for creating different hosting products
    public static function createHostingProduct(array $data): self
    {
        $data['category'] = 'Hosting';
        return self::create($data);
    }
}
