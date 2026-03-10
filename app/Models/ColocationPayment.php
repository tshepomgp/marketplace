<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColocationPayment extends Model
{
    protected $fillable = ['colocation_order_id', 'colocation_sku_id', 'customer_id', 'amount', 'payment_method', 'payment_status', 'transaction_id', 'paid_at', 'metadata'];
    
    protected $casts = ['metadata' => 'array', 'paid_at' => 'datetime'];
    
    public function order()
    {
        return $this->belongsTo(ColocationOrder::class, 'colocation_order_id');
    }
    
    public function sku()
    {
        return $this->belongsTo(ColocationSku::class, 'colocation_sku_id');
    }
    
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
