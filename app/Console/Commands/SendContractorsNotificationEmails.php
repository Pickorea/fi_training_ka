<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlertSystem\ExportActiveExpireEmployeeListTable;
use Mail;
use DB;
use PDF;
use App\Mail\NotifyContractorsMail;

class SendContractorsNotificationEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $filename = "_activeExpireEmployeetable";
        $data['employees'] = DB::table('employees')
            ->select('employees.name', 'employees.updated_at','work_status.work_status_name', 'employee_work_statuses.start_date', 'employee_work_statuses.end_date','employee_work_statuses.unestablished','employee_work_statuses.id')
            ->leftJoin('work_status','work_status.id','=','employees.work_status_id')
            ->leftJoin('employee_work_statuses','employees.id','=','employee_work_statuses.employee_id')
            ->where('work_status.work_status_name','!=','permenant')->orwhere('employee_work_statuses.unestablished','=','unestablished')->whereNotNull('employee_work_statuses.start_date')->whereNotNull('employee_work_statuses.end_date')
            ->get();

        $excel = PDF::loadView('reports.alertsystems._activeExpireEmployeetable', $data);

        \Mail::send('reports.alertsystems._activeExpireEmployeetable',
        $data, function ($m)use($excel){
            // $m->from('kairaoii@mfmrd.gov.ki', env('APP_NAME'));
            $m->to('kairaoi1ien@yahoo.com')->subject('Active and Expire list of Employees')
            ->attachData($excel->output(), '_activeExpireEmployeetable.pdf');
        });

        // \Mail::to('kairaoi1ien@yahoo.com')->send(new NotifyContractorsMail);
    }
}
