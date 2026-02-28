<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


// ============================================================================
// DOMAIN MODEL
// ============================================================================
class Domain extends Model
{
    protected $fillable = [
        'user_id',
        'email_hosting_plan_id',
        'domain_name',
        'order_number',
        'status',
        'registrar',
        'registrar_domain_id',
        'price',
        'registered_date',
        'expiration_date',
        'auto_renew_date',
        'auto_renew',
        'whois_info',
    ];

    protected $casts = [
        'registered_date' => 'date',
        'expiration_date' => 'date',
        'auto_renew_date' => 'date',
        'auto_renew' => 'boolean',
        'whois_info' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emailHostingPlan()
    {
        return $this->belongsTo(EmailHostingPlan::class);
    }

    public function emailAccounts()
    {
        return $this->hasMany(EmailAccount::class);
    }

    public function order()
    {
        return $this->hasOne(EmailHostingOrder::class);
    }

    /**
     * Check if domain is available (from registrar)
     */
    public function isAvailable()
    {
        return $this->status === 'available';
    }

    /**
     * Check if domain is registered
     */
    public function isRegistered()
    {
        return in_array($this->status, ['registered', 'active']);
    }
}