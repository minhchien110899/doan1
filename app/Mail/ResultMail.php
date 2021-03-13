<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResultMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $history, $questions, $testexam;
    public function __construct($history, $questions, $testexam)
    {
        $this->history = $history;
        $this->questions = $questions;
        $this->testexam = $testexam;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Result from MultiChoice')->markdown('user.exam.email_result_detail');
    }
}
