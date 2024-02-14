<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Interview;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewEdit extends Mailable
{
    use Queueable, SerializesModels;

    public $interview;

    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    public function build()
    {
        return $this->view('emails.interviewEdited')
                    ->subject('Your Rescheduled Interview Details');
    }
}
