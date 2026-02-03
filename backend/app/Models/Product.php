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
        'category',
        'price',
        'billing_cycle',
        'features_specs'
    ];

    protected $casts = [
        'features_specs' => 'array',
        'price' => 'decimal:2'
    ];

    // Scopes
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeHosting($query)
    {
        return $query->where('category', 'Hosting');
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
