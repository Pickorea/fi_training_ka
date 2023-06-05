<?php

namespace App\Exports\AlertSystem;

use App\Repositories\AlertSystem\JobTitleRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExportJobTitleListTable
{
    protected $repository;

    public function __construct(JobTitleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function exportToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headings
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Job Title');
        $sheet->setCellValue('C1', 'Department');

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
        $sheet->getStyle('A1:C1')->applyFromArray($headingStyle);

        // Fetch the job titles from the repository
        $jobTitles = $this->repository->getForDataTable();

        // Set the data rows
        $row = 2;
        foreach ($jobTitles as $jobTitle) {
            $sheet->setCellValue('A' . $row, $jobTitle['id']);
            $sheet->setCellValue('B' . $row, $jobTitle['job_title_name']);
            $sheet->setCellValue('C' . $row, $jobTitle['department_name']);
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
        $sheet->getStyle('A2:C' . $lastRow)->applyFromArray($dataStyle);

        // Auto-size the columns
        foreach (range('A', 'C') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set the filename and save the Excel file
        $filename = date('Ymd') . '_mfmrd_job_titles_by_department.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend();
    }
}
