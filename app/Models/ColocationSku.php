<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColocationSku extends Model
{
    protected $fillable = ['name', 'sku_code', 'type', 'rack_units', 'power_supply', 'monthly_price', 'setup_fee', 'description', 'features', 'status'];
    
    protected $casts = ['features' => 'array'];
    
    public function orders()
    {
        return $this->hasMany(ColocationOrder::class);
    }
    
    public function payments()
    {
        return $this->hasMany(ColocationPayment::class);
    }
}
