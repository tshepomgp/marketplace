<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class NewVmOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orderItem;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->orderItem = $order->orderItems->first(); // Assuming single-item order
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New VM Order Placed')
                    ->view('emails.new-vm-order');
    }
}


