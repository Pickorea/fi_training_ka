<?php

namespace App\Exports\AlertSystem;

use App\Models\AlertSytetme\Employee;
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
use Maatwebsite\Excel\Concerns\WithHeadings;



use RegistersEventListeners;
use DB;

class ExportActiveExpireEmployeeListTable implements FromView, 
ShouldAutoSize, WithStyles, WithBackgroundColor,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('reports.alertsystems._activeExpireEmployeetable', [
            'employees' =>DB::table('employees')
            ->select('employees.name', 'employees.updated_at','work_status.work_status_name', 'employee_work_statuses.start_date', 'employee_work_statuses.end_date','employee_work_statuses.unestablished','employee_work_statuses.id')
            ->leftJoin('work_status','work_status.id','=','employees.work_status_id')
            ->leftJoin('employee_work_statuses','employees.id','=','employee_work_statuses.employee_id')
            ->where('work_status.work_status_name','!=','permenant')->orwhere('employee_work_statuses.unestablished','=','unestablished')->whereNotNull('employee_work_statuses.start_date')->whereNotNull('employee_work_statuses.end_date')
            ->get()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            '1' => ['font' => ['italic' => FALSE]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];

        $sheet->cell('A1', function($cell){
            $cell->setBorder('thin','thin','thin','thin');
        });
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

    // public function title() : string
    // {
    //     return 'MATRIK 2';
    // }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) 
            
    //         {
    //             $styleHeader = [
    //                 'borders' => [
    //                     'allBorders' => [
    //                         'borderStyle' => 'thin',
    //                         'color' => ['rgb' => '808080']
    //                     ],
    //                 ]
    //             ];
    //     $event->sheet->getStyle("A1:C1")->applyFromArray($styleHeader);
    //         }
    //     ];
    // }
    public function headings(): array
    {
        return ["your", "headings", "here"];
    }
    
}
