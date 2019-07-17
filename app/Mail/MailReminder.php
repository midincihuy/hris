<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Contract;
class MailReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->details['subject'])
        ->attach('public/uploads/form_usulan_status.pdf')
        ->with('details', $this->details)
        ->view('emails.contract');
    }
}
