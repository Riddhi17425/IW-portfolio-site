<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $data; 

   public function __construct($contact)
    {
        $this->data = $contact;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission')
                    ->view('front.email.contact_admin') 
                    ->with('data', $this->data);
    }
}
 