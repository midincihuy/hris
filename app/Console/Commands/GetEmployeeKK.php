<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Reminder;
use App\Contract;

class GetEmployeeKK extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:employee_kk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Employee With Status KK';

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
        // Populate Employee with Contract Near Expired
        $list_kk = Contract::where('employee_status','KK')
            ->whereYear('contract_expire_date',date("Y"))
            ->whereMonth('contract_expire_date', date("m"))
            ->get();

        $reminders = [];
        foreach($list_kk as $data){
            $head_nik = $data->employee->head_nik;

            $reminders[$head_nik]['to'] = $data->employee->head->email;
            $reminders[$head_nik]['data'][] = [
                'nip' => $data->employee->nip,
                'nama' => $data->employee->nama,
                'position' => $data->position->name,
                'contract_date' => $data->contract_date->toDateString(),
                'contract_expire_date' => $data->contract_expire_date->toDateString(),
            ];
        }
        \Log::info($reminders);
        foreach($reminders as $reminder){
            $x = new Reminder();
            $x->to = $reminder['to'];
            $x->cc = $reminder['to'];
            $x->subject = "Reminder Contract";
            $x->message = $reminder['data'];
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
            $x->save();
        }

    }
}
