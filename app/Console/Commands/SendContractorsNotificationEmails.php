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
        // $data['employees'] = DB::table('employees')
        //     ->select('employees.name', 'employees.updated_at','work_status.work_status_name', 'employee_work_statuses.start_date', 'employee_work_statuses.end_date','employee_work_statuses.unestablished','employee_work_statuses.id')
        //     ->leftJoin('work_status','work_status.id','=','employees.work_status_id')
        //     ->leftJoin('employee_work_statuses','employees.id','=','employee_work_statuses.employee_id')
        //     ->where('work_status.work_status_name','!=','permenant')->orwhere('employee_work_statuses.unestablished','=','unestablished')->whereNotNull('employee_work_statuses.start_date')->whereNotNull('employee_work_statuses.end_date')
        //     ->get();
        $data['employees'] = DB::table('employees')
    ->select(
        'employees.name',
        'work_status.work_status_name',
        'employee_work_statuses.start_date',
        'employee_work_statuses.end_date',
        'employee_work_statuses.unestablished',
        'employee_work_statuses.id',
        'employees.*',
        'departments.department_name',
        'job_titles.name as job_title_name',
        'recommended_salary_scales.name as recommended_salary_scale',
        'recommended_salary_scales.recommended_minimum_salary',
        'recommended_salary_scales.recommended_maximum_salary',
        DB::raw('(CASE WHEN employee_work_statuses.end_date < DATE_ADD(CURDATE(), INTERVAL 3 DAY) THEN "Expired" ELSE "Active" END) AS status'),
        DB::raw('DATEDIFF(employee_work_statuses.end_date, employee_work_statuses.start_date) - (DATEDIFF(employee_work_statuses.end_date, employee_work_statuses.start_date) DIV 7 * 2) - 
                (CASE WHEN WEEKDAY(employee_work_statuses.start_date) = 6 THEN 1 ELSE 0 END) - 
                (CASE WHEN WEEKDAY(employee_work_statuses.end_date) = 5 THEN 1 ELSE 0 END) as day_count')
    )
    ->leftJoin('work_status', 'work_status.id', '=', 'employees.work_status_id')
    ->leftJoin('employee_work_statuses', function($join){
        $join->on('employee_work_statuses.employee_id', '=', 'employees.id')
             ->whereNotNull('employee_work_statuses.start_date')
             ->whereNotNull('employee_work_statuses.end_date');
    })
    ->leftJoin('vacancies', 'vacancies.id', '=', 'employee_work_statuses.vacancy_id')
    ->leftJoin('job_titles', 'job_titles.id', '=', 'vacancies.job_title_id')
    ->leftJoin('departments', 'departments.id', '=', 'vacancies.department_id')
    ->leftJoin('recommended_salary_scales', function($join){
        $join->on('recommended_salary_scales.job_title_id', '=', 'job_titles.id');
    })
    ->where(function($query){
        $query->where('work_status.work_status_name', '!=', 'permanent')
            ->orWhere('employee_work_statuses.unestablished', '=', 'unestablished');
    })
    ->whereNotNull('employee_work_statuses.start_date')
    ->whereNotNull('employee_work_statuses.end_date')
    ->get();

    
            // $data['title'] = 'ACTIVE AND EXPIRED CONTRACTED EMPLOYEE LIST';

        $excel = PDF::loadView('reports.alertSystems._activeExpireEmployeetable', $data);

        \Mail::send('reports.alertSystems._activeExpireEmployeetable',
        $data, function ($m)use($excel){
            // $m->from('kairaoii@mfmrd.gov.ki', env('APP_NAME'));
            $m->to(['kairaoi1ien@yahoo.com','kairaoii@mfmrd.gov.ki'])->subject('ACTIVE AND EXPIRED EMPLOYEES LIST')
            ->attachData($excel->output(), '_activeExpireEmployeetable.pdf');
        });

        // \Mail::to('kairaoi1ien@yahoo.com')->send(new NotifyContractorsMail);
    }
}
