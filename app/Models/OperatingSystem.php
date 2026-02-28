<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'version',
        'type',
        'license_cost',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'license_cost' => 'decimal:2',
    ];

    public function vmOrders()
    {
        return $this->hasMany(VmOrder::class);
    }
}
