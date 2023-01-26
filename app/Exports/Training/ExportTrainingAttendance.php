<?php

namespace App\Exports\Training;

use App\Models\Training\Island;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use PhpOffice\PhpSpreadsheet\Shared\Date;
// use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

// use Maatwebsite\Excel\Concerns\WithDrawings;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// use PhpOffice\PhpSpreadsheet\Style\Fill;
// use PhpOffice\PhpSpreadsheet\Style\Style;
// use PhpOffice\PhpSpreadsheet\Style\Color;
// use Maatwebsite\Excel\Concerns\WithDefaultStyles;
// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// use PhpOffice\PhpSpreadsheet\Style\Fill;
// use PhpOffice\PhpSpreadsheet\Style\Style;
// use PhpOffice\PhpSpreadsheet\Style\Color;
// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
// use Maatwebsite\Excel\Concerns\WithBackgroundColor;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;


use RegistersEventListeners;
use DB;

class ExportTrainingAttendance implements FromCollection, 
WithHeadings, ShouldAutoSize, WithStyles
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $trainingAttendance = DB::table('islands')
        ->select('trainings.id', 'islands.island_name', 'villages.village_name', 'trainings.training_date', 'training_details.participant_first_name', 'training_details.participant_last_name', 'training_details.age', 'training_details.gender', 'training_types.training_name')
        ->leftJoin('trainings','islands.id','=','trainings.island_id')
        ->leftJoin('training_types','trainings.training_type_id','=','training_types.id')
        ->leftJoin('training_details','trainings.id','=','training_details.training_id')
        ->leftJoin('villages','training_details.village_id','=','villages.id')
        ->whereNotNull('trainings.training_type_id')
        ->whereNotNull('training_details.village_id')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Numbering',
            'Island Name',
             'Village Name',
             'Training Date',
            'First Name',
            'Last Name',
            'Age',
            'Gender',
            'Training Name',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'A' => ['font' => ['italic' => true]],
            'B' => ['font' => ['italic' => true]],
            'C' => ['font' => ['italic' => true]],
            'D' => ['font' => ['italic' => true]],
            'E' => ['font' => ['italic' => true]],
            'F' => ['font' => ['italic' => true]],
            'G' => ['font' => ['italic' => true]],
            'H' => ['font' => ['italic' => true]],
            'I' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    // public function defaultStyles(Style $defaultStyle)
    // {
    //     // Configure the default styles
    //     return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);
    
    //     // Or return the styles array
    //     return [
    //         'fill' => [
    //             'fillType'   => Fill::FILL_SOLID,
    //             'startColor' => ['argb' => Color::RED],
    //         ],
    //     ];
    // }

    // public function backgroundColor()
    // {
    //     // Return RGB color code.
    //     return '6704354';
    
    //     // Return a Color instance. The fill type will automatically be set to "solid"
    //     return new Color(Color::COLOR_BLUE);
    
    //     // Or return the styles array
    //     return [
    //          'fillType'   => Fill::FILL_GRADIENT_LINEAR,
    //          'startColor' => ['argb' => Color::COLOR_RED],
    //     ];
    // }

    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 10,
    //         'B' => 10, 
    //         'C' => 10, 
    //         'D' => 5, 
    //         'E' => 10, 
    //         'F' => 10, 
    //         'G' => 7,            
    //     ];
    // }

   
}
