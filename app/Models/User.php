<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'customer_id',
        'company_name',
         'credit_limit',  
         'credit_used',   
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

   
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Check if user is customer
    public function isCustomer()
    {
        return $this->role === 'customer';
    }

        // ADD THESE 3 METHODS:

    /**
     * Get all VM orders for this user
     */
    public function vmOrders()
    {
        return $this->hasMany(VmOrder::class, 'customer_id', 'id');
    }

    /**
     * Get all storage orders for this user
     */
    public function storageOrders()
    {
        return $this->hasMany(StorageOrder::class, 'customer_id', 'id');
    }

    /**
     * Alias for orders (same as vmOrders)
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function creditTransactions()
{
    return $this->hasMany(CreditTransaction::class);
}

public function getAvailableCredit()
{
    return $this->credit_limit - $this->credit_used;
}
}
