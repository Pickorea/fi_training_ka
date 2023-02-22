<?php
namespace App\KoolReports\Training;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
// use Maatwebsite\Excel\Concerns\Exportable;

class TrainingReport extends \koolreport\KoolReport
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
        ->query("SELECT Island, Village, Date, Training, Male, Female, Total
        FROM (
            select islands.island_name as Island,
                   villages.village_name as Village,
                   trainings.training_date as Date,
                   training_types.training_name as Training,
                   count(case when training_details.gender = 1 then 1 end) as Male,
                   count(case when training_details.gender = 0 then 1 end) as Female,
                   count(*) as Total 
            from islands 
            left join trainings on islands.id = trainings.island_id 
            left join training_types on training_types.id = trainings.training_type_id 
            left join training_details on training_details.training_id = trainings.id 
            left join villages on villages.id = training_details.village_id 
            GROUP BY trainings.training_date, islands.island_name, villages.village_name, training_types.training_name
        ) as t
        WHERE NOT (Total = 1 AND Male = 0 AND Female = 0);
        ")
        ->pipe(new Sort(array(
            "training_date"=>"asc"
        )))
        ->pipe($this->dataStore(""));        
    }
}