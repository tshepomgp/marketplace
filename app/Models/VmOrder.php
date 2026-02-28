<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VmOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_number',
        'vm_sku_id',
        'operating_system_id',
        'disk_size_gb',
        'quantity',
        'vm_name',
        'notes',
        'monthly_cost',
        'setup_fee',
        'currency',
        'status',
        'approved_at',
        'provisioned_at',
        'total_amount',
        'product_id',
    ];

    protected $casts = [
        'monthly_cost' => 'decimal:2',
        'setup_fee' => 'decimal:2',
        'approved_at' => 'datetime',
        'provisioned_at' => 'datetime',
    ];



public function customer()
{
    return $this->belongsTo(User::class, 'customer_id');
}

public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'customer_id', 'id');
}

    public function vmSku()
    {
        return $this->belongsTo(VmSku::class);
    }

    public function operatingSystem()
    {
        return $this->belongsTo(OperatingSystem::class);
    }
}
