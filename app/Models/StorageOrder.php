<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_number',
        'storage_sku_id',
        'storage_type',
        'size_gb',
        'quantity',
        'storage_name',
        'notes',
        'monthly_cost',
        'currency',
        'status',
        'approved_at',
        'provisioned_at',
    ];

    protected $casts = [
        'monthly_cost' => 'decimal:2',
        'approved_at' => 'datetime',
        'provisioned_at' => 'datetime',
    ];

    public function customer()
{
    return $this->belongsTo(User::class, 'customer_id');
}

     public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function storageSku()
    {
        return $this->belongsTo(StorageSku::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
}
