<?php

namespace App\Exports\Training;

use App\Models\Training\Island;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Chart\Axis;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportTrainingAttendanceTable implements FromView, ShouldAutoSize, WithStyles, WithBackgroundColor
{
    public function view(): View
    {
        $trainings = DB::table('islands')
            ->select('islands.island_name as Island', 'villages.village_name as Village', 'trainings.training_date as Date', 'training_types.training_name as Training',
                DB::raw('count(case when training_details.gender = 1 then 1 end) as Male'),
                DB::raw('count(case when training_details.gender = 0 then 1 end) as Female'),
                DB::raw('count(*) as Total'))
            ->leftJoin('trainings', 'islands.id', '=', 'trainings.island_id')
            ->leftJoin('training_types', 'training_types.id', '=', 'trainings.training_type_id')
            ->leftJoin('training_details', 'training_details.training_id', '=', 'trainings.id')
            ->leftJoin('villages', 'villages.id', '=', 'training_details.village_id')
            ->groupBy('trainings.training_date', 'islands.island_name', 'villages.village_name', 'training_types.training_name')
            ->havingRaw('NOT (Total = 1 AND Male = 0 AND Female = 0)')
            ->get();

        $collection = Collection::make($trainings);

        // $chart = new Chart(
        //     'chart1', // name
        //     new Title('Training Attendance Chart'), // title
        //     new Legend(Legend::POSITION_RIGHT), // legend
        //     new PlotArea(null, [new DataSeries(
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$2', null, 1), // X-axis labels
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$C$2:$D$2', null, 1), // Y-axis values
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$E$2:$F$2', null, 1) // Z-axis values
        //     )]),
        //     true, // plot visible cells only
        //     new Axis('x', null, null, null, true), // X-axis options
        //     new Axis('y') // Y-axis options
        // );

        // $sheet = $this->getActiveSheet();
        // $sheet->setTitle('Chart');
        // $sheet->addChart($chart);

        return view('reports.trainings._table', ['collection' => $collection]);
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
