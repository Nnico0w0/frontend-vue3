<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name', 
        'email',
        'phone',
        'address',
        'city',
        'country',
        'password',
        'is_email_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_email_verified' => 'boolean',
        'password' => 'hashed',
    ];

    // Accessors
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Mutators
    public function setPasswordAttribute($value)
    {
        if ($value) {
            // Store password in history before changing
            if ($this->exists && $this->password !== $value) {
                $this->passwordHistories()->create([
                    'password_hash' => $this->password,
                    'changed_by_id' => auth()->id() ?? $this->id,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);
            }
            $this->attributes['password'] = Hash::make($value);
        }
    }

    // Relationships
    public function passwordHistories(): HasMany
    {
        return $this->hasMany(PasswordHistory::class);
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscriptions(): HasMany
    {
        return $this->subscriptions()->where('status', 'Active');
    }

    // Business Methods
    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscriptions()->exists();
    }

    public function getTotalSpent(): float
    {
        return $this->orders()->where('status', 'Paid')->sum('total');
    }
}
