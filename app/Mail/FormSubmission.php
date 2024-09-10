<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public function __construct($maildata)
    {
        $this->formData = $maildata;
    }

    public function build()
    {
        return $this->subject('New Form Submission')
            ->view('emails.form-submission');
    }
}
