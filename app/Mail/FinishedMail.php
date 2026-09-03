<?php

namespace App\Mail;

use App\Http\Controllers\PageDisplayController;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Lunar\Models\Order;
use Ramsey\Uuid\Type\Integer;

class FinishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $chunker;
    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order = null, int $order_id = 0)
    {
        
        if($order_id > 0){
            $this->order = Order::find($order_id);
        }else{
            $this->order = $order;
        }
        $this->chunker = PageDisplayController::dajChunker();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->chunker['order_mail_subject'].' - '.$this->order->reference,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.finished-mail',
            with: [
                'tekst' => $this->chunker['order_mail_text'],
                'order' => $this->order, 
                ]
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
