<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contract;
use Mail;
use App\Mail\Reminder;

class ReminderContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder For Contract HRIS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      \Log::info('start reminder');
      $date = date("m-d");
      $contract = Contract::where(\DB::Raw('date_format(contract_date,"%m-%d")'),\DB::Raw('"'.$date.'"'))->groupBy('email_head_1')->get();
      foreach($contract as $data){
        $list = Contract::where(\DB::Raw('date_format(contract_date,"%m-%d")'),\DB::Raw('"'.$date.'"'))->where('email_head_1', $data->email_head_1)->get();
        $email_to = $data->email_head_1;
        Mail::to($email_to)
          ->send(new Reminder($list));
      }
      \Log::info('finish reminder');
    }
}
