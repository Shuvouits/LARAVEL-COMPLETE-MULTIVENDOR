<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
   /* public function content()
    {
        $order = $this->data;

       // return $this->from('shuvo21.xpertseoservice@hotmail.com')->view('mail.order_mail', compact('order'));

        return new Content(
            from: 'shuvo21.xpertseoservice@hotmail.com',
            view: 'mail.order_mail',compact('order'),
        );
    } */ 

    public function build(){
        $order = $this->data;

        return $this->from('shuvo21.xpertseoservice@hotmail.com')->view('mail.order_mail', compact('order'))->subject('Email from Easy Multivendor Shop');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}