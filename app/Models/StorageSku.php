<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageSku extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'min_size_gb',
        'max_size_gb',
        'price_per_gb_monthly',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_per_gb_monthly' => 'decimal:2',
    ];

    public function storageOrders()
    {
        return $this->hasMany(StorageOrder::class);
    }
}
