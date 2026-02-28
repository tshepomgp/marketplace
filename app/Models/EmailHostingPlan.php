<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// ============================================================================
// EMAIL HOSTING PLAN MODEL
// ============================================================================
class EmailHostingPlan extends Model
{
    protected $fillable = [
        'name',
        'sku_code',
        'description',
        'price_per_mailbox',
        'domain_price',
        'storage_gb',
        'mailboxes_included',
        'features',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function orders()
    {
        return $this->hasMany(EmailHostingOrder::class);
    }
}
