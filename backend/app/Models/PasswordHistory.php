<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'password_hash',
        'changed_by_id', 
        'ip_address',
        'user_agent'
    ];

    protected $hidden = [
        'password_hash'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_id');
    }

    // Business Methods
    public function getChangeTypeAttribute(): string
    {
        return $this->changed_by_id === $this->user_id ? 'Self-changed' : 'Admin-changed';
    }
}
