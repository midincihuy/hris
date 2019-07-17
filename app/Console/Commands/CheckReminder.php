<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Reminder;
use App\Jobs\SendEmailJob;

class CheckReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Which Contract Need To Reminder';

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
        // // Populate Employee with Contract Near Expired
        // $list_kk = Employee::where('employee_status','KK')->whereHas('contract', function($query){ 
        //     $query->whereYear('contract_expire_date',date("Y"));
        //     $query->whereMonth('contract_expire_date', date("m"));
        // })->get();

        // $x = new Reminder();
        // $x->to = 'hamidin.hidayat@ochanneltv.com';
        // $x->cc = 'hamidin.hidayat@ochanneltv.com';
        // $x->subject = 'test dari db';
        // $x->message = [
        //     [
        //         'nik' => '1234',
        //         'name' => 'midincihuyoke',
        //         'position' => 'IT Head',
        //         'contract_date' => '2019-03-01',
        //         'contract_expire_date' => '2019-03-01',
        //     ],
        //     [
        //         'nik' => '12345',
        //         'name' => 'midincihuy',
        //         'position' => 'IT Head2',
        //         'contract_date' => '2019-03-02',
        //         'contract_expire_date' => '2019-03-22',
        //     ],
        // ];
        // $x->save();
        $reminders = Reminder::whereStatus('New')->get();
        foreach($reminders as $reminder){
            $details = array();
            $details['to'] = $reminder->to;
            $details['cc'] = $reminder->cc;
            $details['subject'] = $reminder->subject;
            $details['message'] = $reminder->message;

            \Log::info($details);
            dispatch(new SendEmailJob($details));
            $reminder->status = "Sent";
            $reminder->sent_time = date("Y-m-d H:i:s");
            $reminder->save();
        }
    }
}
