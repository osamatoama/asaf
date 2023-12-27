<?php

namespace App\Mail\Dashboard\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordResetCode extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function build(): self
    {
        return $this
            ->from('no-reply@3saf.com')
            ->subject('Password reset code')
            ->view('emails.verification');
    }
}
