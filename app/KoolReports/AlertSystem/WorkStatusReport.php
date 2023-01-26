<?php
namespace App\KoolReports\AlertSystem;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
// use Maatwebsite\Excel\Concerns\Exportable;

class WorkStatusReport extends \koolreport\KoolReport
{
    // use \koolreport\excel\ExcelExportable;
    // use Maatwebsite\Excel\Concerns\Exportable;
    use \koolreport\laravel\Friendship;
    // use \koolreport\bootstrap4\Theme;
    // By adding above statement, you have claim the friendship between two frameworks
    // As a result, this report will be able to accessed all databases of Laravel
    // There are no need to define the settings() function anymore
    // while you can do so if you have other datasources rather than those
    // defined in Laravel.
    

    function setup()
    {
        // Let say, you have "sale_database" is defined in Laravel's database settings.
        // Now you can use that database without any futher setitngs.
        $this->src("")
        ->query("select employees.name as 'Employee Name', work_status.work_status_name as 'Work Status' from employees left join work_status on work_status.id = employees.work_status_id")
        ->pipe(new Sort(array(
            "employee_work_statuses.end_date"=>"asc"
        )))
        ->pipe($this->dataStore(""));        
    }
}