<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Contract;
class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract)
    {
        $this->contract = array("contract" => $contract);
        \Log::info(json_encode($this->contract));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('hamidin.hidayat@oshop.co.id')
        // ->attach('./storage/exports/SKU_Checking_'.date("Y_m_d").".xls")
        ->with('contract', $this->contract)
        ->view('emails.contract');
    }
}
