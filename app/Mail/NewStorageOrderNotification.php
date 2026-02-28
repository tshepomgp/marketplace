<?php

namespace App\Mail;

use App\Models\StorageOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewStorageOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public StorageOrder $storageOrder;

    /**
     * Create a new message instance.
     */
    public function __construct(StorageOrder $storageOrder)
    {
        $this->storageOrder = $storageOrder;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Storage Order Received')
                    ->view('emails.storage-order')
                    ->with([
                        'storageOrder' => $this->storageOrder,
                    ]);
    }
}
