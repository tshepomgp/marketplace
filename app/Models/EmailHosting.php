<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




// ============================================================================
// EMAIL HOSTING ORDER MODEL
// ============================================================================
class EmailHostingOrder extends Model
{
    protected $fillable = [
        'user_id',
        'domain_id',
        'email_hosting_plan_id',
        'order_number',
        'domain_price',
        'hosting_price',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'payment_date',
        'order_data',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'order_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function emailHostingPlan()
    {
        return $this->belongsTo(EmailHostingPlan::class);
    }
}
