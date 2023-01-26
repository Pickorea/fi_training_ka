<?php

namespace App\Exports\Training;

use App\Models\Training\Island;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;



use RegistersEventListeners;
use DB;

class ExportTrainingAttendanceTable implements FromView, 
ShouldAutoSize, WithStyles, WithBackgroundColor
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('reports.trainings._table', [
            'trainings' => DB::table('islands')
            ->select('trainings.id', 'islands.island_name', 'villages.village_name', 'trainings.training_date', 'training_details.participant_first_name', 'training_details.participant_last_name', 'training_details.age', 'training_details.gender', 'training_types.training_name')
            ->leftJoin('trainings','islands.id','=','trainings.island_id')
            ->leftJoin('training_types','trainings.training_type_id','=','training_types.id')
            ->leftJoin('training_details','trainings.id','=','training_details.training_id')
            ->leftJoin('villages','training_details.village_id','=','villages.id')
            ->whereNotNull('trainings.training_type_id')
            ->whereNotNull('training_details.village_id')
            ->get()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function backgroundColor()
    {
        // Return RGB color code.
        // return '000000';
    
        // Return a Color instance. The fill type will automatically be set to "solid"
        // return new Color(Color::COLOR_BLUE);
    
        // Or return the styles array
        // return [
        //      'fillType'   => Fill::FILL_GRADIENT_LINEAR,
        //      'startColor' => ['argb' => Color::COLOR_RED],
        // ];
    }
}
