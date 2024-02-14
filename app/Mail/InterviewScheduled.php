<?php

namespace App\Mail;

use App\Models\Interview;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $interview;

    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    public function build()
    {
        return $this->view('emails.interviewScheduled')
                    ->with([
                        'loginEmail' => $this->interview->user->email,
                        'password' => 'Welcome@123',
                    ])
                    ->subject('Your Interview Details');
    }
}
