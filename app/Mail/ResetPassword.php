<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResetPassword extends Mailable
{
    
    public $resetUrl;

    public function __construct(string $token, string $email)
    {
        $this->resetUrl = route('password.reset', [
            'token' => $token,
            'email' => $email
        ], true);
    }

    public function build()
    {
        return $this->subject('パスワード再設定のご案内')
                    ->markdown('emails.reset-password');
    }
    
}