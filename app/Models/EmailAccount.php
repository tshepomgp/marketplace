<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




// ============================================================================
// EMAIL ACCOUNT MODEL
// ============================================================================
class EmailAccount extends Model
{
    protected $fillable = [
        'user_id',
        'domain_id',
        'email_address',
        'mailbox_name',
        'password',
        'status',
        'imap_host',
        'smtp_host',
        'imap_port',
        'smtp_port',
        'imap_ssl',
        'smtp_tls',
        'storage_gb',
        'storage_used_gb',
    ];

    protected $casts = [
        'imap_ssl' => 'boolean',
        'smtp_tls' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}