<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VmSku extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'vcpus',
        'ram_gb',
        'price_monthly',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_monthly' => 'decimal:2',
    ];

    public function vmOrders()
    {
        return $this->hasMany(Order::class, 'id');
    }
}
