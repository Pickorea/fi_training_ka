<?php

namespace App\Exports\AlertSystem;

use App\Repositories\AlertSystem\EmployeeWorkStatusRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExportEmployeeWorkStatusListTable
{
    protected $repository;

    public function __construct(EmployeeWorkStatusRepository $repository)
    {
        $this->repository = $repository;
    }

    public function exportToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

                // Set the column headings
            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'NAME');
            $sheet->setCellValue('C1', 'WORK STATUS');
            $sheet->setCellValue('D1', 'START DATE');
            $sheet->setCellValue('E1', 'END DATE');
            $sheet->setCellValue('F1', 'DAYS LIMIT');
            $sheet->setCellValue('G1', 'DEPARTMENT');
            $sheet->setCellValue('H1', 'JOB TITLE');
            $sheet->setCellValue('I1', 'RECOMMENDED SALARY SCALE');
            $sheet->setCellValue('J1', 'ACTIVITY STATUS');
            $sheet->setCellValue('K1', 'REMAINING WORK DAYS');


        // Set the styles for the column headings
        $headingStyle = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'EEEEEE',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A1:K1')->applyFromArray($headingStyle);

          // Fetch the employee work statuses from the repository
$empWorkStatuses = $this->repository->getForDataTable()['employees'];

// Set the data rows
$row = 2;
foreach ($empWorkStatuses as $empWorkStatus) {
    $sheet->setCellValue('A' . $row, $empWorkStatus['employee_work_status_id'] ?? '');
    $sheet->setCellValue('B' . $row, $empWorkStatus['employee_name'] ?? '');
    $sheet->setCellValue('C' . $row, $empWorkStatus['work_status_name'] ?? '');
    $sheet->setCellValue('D' . $row, $empWorkStatus['start_date'] ?? '');
    $sheet->setCellValue('E' . $row, $empWorkStatus['end_date'] ?? '');
    $sheet->setCellValue('F' . $row, $empWorkStatus['day_count'] ?? '');
    $sheet->setCellValue('G' . $row, $empWorkStatus['department'] ?? '');
    $sheet->setCellValue('H' . $row, $empWorkStatus['job_title'] ?? '');
    $sheet->setCellValue('I' . $row, $empWorkStatus['recommended_salary_scale'] ?? '');
    $sheet->setCellValue('J' . $row, $empWorkStatus['status'] ?? '');
    $sheet->setCellValue('K' . $row, $empWorkStatus['countdown'] ?? '');
    $row++;
}


        // Set the styles for the data rows
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $lastRow = $row - 1;
        $sheet->getStyle('A2:K' . $lastRow)->applyFromArray($dataStyle);

        // Auto-size the columns
        foreach (range('A', 'K') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

      // Set the filename and save the Excel file
        $filename = date('Ymd') . '_mfmrd_employee_work_status.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend();
    }
}
