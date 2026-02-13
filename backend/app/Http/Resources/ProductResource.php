<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'category' => $this->category,
            'price' => (float) $this->price,
            'billing_cycle' => $this->billing_cycle,
            'description' => $this->description,
            'technical_specs' => $this->technical_specs,
            'is_active' => $this->is_active,
            'price_formatted' => $this->getPriceFormatted(),
            'billing_cycle_label' => $this->getBillingCycleLabel(),
            'full_price_label' => $this->getFullPriceLabel(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
