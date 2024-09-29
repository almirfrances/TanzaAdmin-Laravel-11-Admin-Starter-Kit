<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class SendVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $entity;

    /**
     * Accept either a User or Vendor model.
     */
    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Email Verification Code')
                    ->view('emails.verify_code')
                    ->with([
                        'code' => $this->entity->verification_code, 
                    ]);
    }
}