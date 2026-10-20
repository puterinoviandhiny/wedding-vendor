<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'business_type',
        'email',
        'phone',
        'whatsapp',
        'address',
        'city',
        'province',
        'logo',
        'invoice_prefix',
        'invoice_notes',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Business $business) {
            if (!$business->slug) {
                $business->slug = Str::slug($business->name);
            }
        });
    }
}