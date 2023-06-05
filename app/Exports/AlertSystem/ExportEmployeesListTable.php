<?php

namespace App\Exports\AlertSystem;

use App\Repositories\AlertSystem\EmployeeRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExportEmployeesListTable
{
    protected $repository;

    public function __construct(EmployeeRepository $repository)
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
        $sheet->setCellValue('C1', 'MARTIAL STATUS');
        $sheet->setCellValue('D1', 'EMAIL');
        $sheet->setCellValue('E1', 'WORK STATUS');
        $sheet->setCellValue('F1', 'JOB TITLE');
        $sheet->setCellValue('G1', 'DEPARTMENT NAME');
        $sheet->setCellValue('H1', 'PF');
        $sheet->setCellValue('I1', 'JOINING DATE');
        $sheet->setCellValue('J1', 'GENDER');
        $sheet->setCellValue('K1', 'DoB');
        $sheet->setCellValue('L1', 'PHOTO');

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
        $sheet->getStyle('A1:L1')->applyFromArray($headingStyle);

        /// Fetch the employees from the repository
    $employees = $this->repository->getForDataTable();

    // Set the data rows
$row = 2;
foreach ($employees as $employee) {
    $sheet->setCellValue('A' . $row, $employee['id']);
    $sheet->setCellValue('B' . $row, $employee['name']);

    // Ternary operator for marital status
    $maritalStatus = $employee['marital_status'] === '1' ? 'Married' :
                     ($employee['marital_status'] === '2' ? 'Single' :
                     ($employee['marital_status'] === '3' ? 'Divorced' :
                     ($employee['marital_status'] === '4' ? 'Separated' :
                     ($employee['marital_status'] === '5' ? 'Widowed' : ''))));

    $sheet->setCellValue('C' . $row, $maritalStatus);

    $sheet->setCellValue('D' . $row, $employee['email']);
    $sheet->setCellValue('E' . $row, $employee['work_status_name']);
    $sheet->setCellValue('F' . $row, $employee['job_title_name']);
    $sheet->setCellValue('G' . $row, $employee['department_name']);
    $sheet->setCellValue('H' . $row, $employee['pf_number']);
    $sheet->setCellValue('I' . $row, $employee['joining_date']);

    // Ternary operator for gender
    $gender = $employee['gender'] === '1' ? 'Female' : 'Male';
    $sheet->setCellValue('J' . $row, $gender);

    $sheet->setCellValue('K' . $row, $employee['date_of_birth']);
    
    // Insert the employee picture
    if ($employee['picture']) {
        $picturePath = public_path('uploads/employees/' . $employee['picture']);
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Profile Picture');
        $drawing->setDescription('Profile Picture');
        $drawing->setPath($picturePath);
        $drawing->setWidth(100); // Set the desired width of the picture
        $drawing->setHeight(20); // Set the desired height of the picture
        $drawing->setCoordinates('L' . $row); // Set the cell where the picture should be inserted
        $drawing->setWorksheet($sheet);
    }

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
        $sheet->getStyle('A2:L' . $lastRow)->applyFromArray($dataStyle);

        // Auto-size the columns
        foreach (range('A', 'L') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set the filename and save the Excel file
        $filename = date('Ymd') . '_mfmrd_employee_list.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend();
    }
}
