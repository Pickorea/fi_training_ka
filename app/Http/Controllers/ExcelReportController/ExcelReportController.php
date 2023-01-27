<?php

namespace App\Http\Controllers\ExcelReportController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\KoolReports\Training\TrainingReport;
use App\KoolReports\AlertSystem\WorkStatusReport;
use \koolreport\excel\ExcelExportable;
use App\Models\Training\Url;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Training\ExportTrainingAttendance;
use App\Exports\Training\ExportTrainingAttendanceTable;
use PDF;
use DB;

class ExcelReportController extends Controller
{
   
//url report
    // public function _repo()
    // {
    //             $urls = Url::select('name','url')->get();
    //     // dd($route);

    //     return view("reports._repo")->withUrls($urls);
    // }

  
//excel report
    public function exportTrainingAttendance(Request $request){
        
        return Excel::download(new ExportTrainingAttendance, 'Training_attendance.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

//excel report
    public function export() 
    {
        return Excel::download(new ExportTrainingAttendanceTable, '_table.xlsx');
    }
//pdf report
    public function generatePDF()
    {
        $trainings = DB::table('islands')
        ->select('trainings.id', 'islands.island_name', 'villages.village_name', 'trainings.training_date', 'training_details.participant_first_name', 'training_details.participant_last_name', 'training_details.age', 'training_details.gender', 'training_types.training_name')
        ->leftJoin('trainings','islands.id','=','trainings.island_id')
        ->leftJoin('training_types','trainings.training_type_id','=','training_types.id')
        ->leftJoin('training_details','trainings.id','=','training_details.training_id')
        ->leftJoin('villages','training_details.village_id','=','villages.id')
        ->whereNotNull('trainings.training_type_id')
        ->whereNotNull('training_details.village_id')
        ->get();

      $pdf = PDF::loadView('reports.trainings._table', ['trainings' => $trainings ])->setPaper('a4', 'landscape');
    
        return $pdf->download('training_attendance.pdf');
    }
}
