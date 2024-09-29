<?php

namespace App\Traits;

use App\Mail\SendVerificationCode;
use Illuminate\Support\Facades\Mail;

trait SendsVerificationCode
{


    public function sendVerificationCode()
    {
        $this->verification_code = rand(100000, 999999);
        $this->save();

        Mail::to($this->email)->send(new SendVerificationCode($this));
    }
}