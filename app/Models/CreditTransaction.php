<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_type',
        'reference_id',
        'amount',
        'balance_before',
        'balance_after',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}