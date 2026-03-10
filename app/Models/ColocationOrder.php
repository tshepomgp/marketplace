<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColocationOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'colocation_sku_id',
        'order_number',
        'colocation_type',
        'monthly_cost',
        'location',
        'power_requirement',
        'organization_name',
        'contact_name',
        'email',
        'payment_method',
        'payment_status',
        'status',
        'special_requirements',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function sku()
    {
        return $this->belongsTo(ColocationSku::class, 'colocation_sku_id');
    }

    public function payments()
    {
        return $this->hasMany(ColocationPayment::class);
    }
}
