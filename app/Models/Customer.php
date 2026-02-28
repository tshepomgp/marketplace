<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'microsoft_customer_id',
        'domain',
        'tenant_id',
        'status',
    ];

    public function customer()
{
    return $this->belongsTo(Customer::class);
}

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function vmOrders()
    {
        return $this->hasMany(VmOrder::class);
    }

    public function storageOrders()
    {
        return $this->hasMany(StorageOrder::class);
    }
}
