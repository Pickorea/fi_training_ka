<?php

namespace App\Http\Controllers\AlertSystem;

use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\WorkStatusRepository;
use App\Repositories\AlertSystem\EmployeeRepository;
use App\Repositories\AlertSystem\EmployeeWorkStatusRepository;
use App\Repositories\AlertSystem\RecommendedSalaryScalesRepository;
use App\Repositories\AlertSystem\VacancyRepository;
use App\Repositories\AlertSystem\JobTitleRepository;
use App\Models\AlertSystem\JobTitle;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\EmployeeWorkStatus;
use App\Models\AlertSystem\WorkStatus;
use App\Models\AlertSystem\Vacancy;
use App\Models\AlertSystem\RecommendedSalaryScale;

use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\Exports\AlertSystem\ExportEmployeeWorkStatusListTable;
use Maatwebsite\Excel\Facades\Excel;
class EmployeeWorkStatusController extends Controller {

	private $employees;

	private $workstatus;

	private $employeesworkstatus;

	private $vacancy;


	private $recommendedsalaryscales;

	private $jobtitles;



    public function __construct(
		RecommendedSalaryScalesRepository $recommendedsalaryscales, 
		JobTitleRepository $jobtitles,
		WorkStatusRepository $workstatus,
		EmployeeRepository $employees,
		EmployeeWorkStatusRepository $employeesworkstatus,
		VacancyRepository $vacancy
	)
    {
        $this->employees=$employees;

		$this->workstatus=$workstatus;

		$this->vacancy=$vacancy;

		$this->recommendedsalaryscales=$recommendedsalaryscales;

		$this->jobtitles=$jobtitles;

		$this->employeesworkstatus = $employeesworkstatus;
      
       
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	
	

	public function index()
	{
	
		return view('alertsystems.employeeworkstatuses.index');


	}
	
	
	public function getDataTables(Request $request)
{
    $search = $request->get('search', '');
    $order_by = $request->get('order_by', 'id');
    $sort = $request->get('sort', 'asc');

    $data = $this->employeesworkstatus->getForDataTable($search, $order_by, $sort);
	

    // Transform the data to match the desired structure
    $transformedData = [];

    foreach ($data['employees'] as $item) {
        $employee = $item->employee_name;
        $workStatusName = $item->work_status_name;
        $department = $item->department;

        $transformedData[] = [
            'employee' => $employee,
            'work_status_name' => $workStatusName,
            'start_date' => $item->start_date,
            'end_date' => $item->end_date,
            'day_count' => $item->day_count,
            'countdown' => $item->countdown,
            'department' => $department,
            'job_title' => $item->job_title,
            'recommended_salary_scale' => $item->recommended_salary_scale,
            'status' => $item->status,
            'action' => '<a href="' . url('employeeworkstatuses') . '/' . $item->employee_work_status_id . '/edit" class="btn btn-sm btn-primary">Edit</a> <a href="' . url('employeeworkstatuses') . '/' . $item->employee_work_status_id . '" class="btn btn-sm btn-secondary">Show</a>',
        ];
    }

    $result = [
        'data' => $transformedData,
        'jobTitleId' => $data['jobTitleId'],
    ];

    return $result;
}



public function exportToExcel()
	{
		// Create an instance of the ExportEmployeeWorkStatusListTable class
		$exporter = new ExportEmployeeWorkStatusListTable($this->employeesworkstatus);

		// Call the exportToExcel method of the exporter to generate the Excel file
		return $exporter->exportToExcel();
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create()
{
    if (!Auth::user()->can('hr.create')) {
        abort(403, 'Unauthorized action.');
    }

    $workstatuses = $workstatus=$this->workstatus->pluck();
	// dd($workstatuses);
	$employees = $employees=$this->employees->pluck();   
	// dd($employees);
	$vacancies=$this->vacancy->pluck();
	// dd($vacancies);
    $salaryScales=$this->recommendedsalaryscales->pluck();
	// dd($salaryScales);

    return view('alertsystems.employeeworkstatuses.create')
        ->with('workstatuses', $workstatuses)
        ->with('employees', $employees)
        ->with('vacancies', $vacancies)
        ->with('salaryScales', $salaryScales);
}

	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		// dd($request->all());
		
		if (! Auth::user()->can('hr.store')) {
            abort(403, 'Unauthorized action.');
        }
		          
					$input = ['employee_id'=>$request->employee_id,
					'start_date'=> $request->start_date,
					'end_date'=> $request->end_date,
					'vacancy_id'=> $request->vacancy_id,
					'recommended_salary_scale_id'=> $request->recommended_salary_scale_id,
					'unestablished'=> 'unestablished'
				];

	
					$results = $this->employeesworkstatus->create($input);

			
				return redirect()->route('employeeworkstatuses.index');
	}

	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		if (!Auth::user()->can('hr.show')) {
			abort(403, 'Unauthorized action.');
		}
		$employee = Employee::with([
			'workstatus', 
			'department', 
			'jobTitle', 
			'employeeWorkStatuses' => function($query) {
				$latestWorkStatus = $query->orderBy('updated_at', 'desc')->first();
				// dd($latestWorkStatus);
			}
		])->findOrFail($id);
		
	
		$employee = Employee::with(['workStatus', 'department', 'jobTitle', 'employeeWorkStatuses' => function($query) {
			$query->orderBy('updated_at', 'desc')->first();
		}])->findOrFail($id);
		
		
		// dd($employee);
		// dd(\DB::getQueryLog());


	
		if (!$employee) {
			return redirect()->route('employeeworkstatuses.index')
							 ->with('error', 'Employee work status not found');
		}
	
		return view('alertsystems.employeeworkstatuses.show')
			->with('employee', $employee);
	}
	

	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
{
    if (!Auth::user()->can('hr.create')) {
        abort(403, 'Unauthorized action.');
    }

    $model = EmployeeWorkStatus::findOrFail($id);
    $workstatuses = $this->workstatus->pluck();
    $employees = $this->employees->pluck();   
    $vacancies = $this->vacancy->pluck();
    $salaryScales = $this->recommendedsalaryscales->pluck();

    return view('alertsystems.employeeworkstatuses.edit', compact('model', 'workstatuses', 'employees', 'vacancies', 'salaryScales'));
}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
{
	// dd($request->all());
    if (!Auth::user()->can('hr.update')) {
        abort(403, 'Unauthorized action.');
    }

    $employeeworkstatus = EmployeeWorkStatus::findOrFail($id);

    // Validate the end date
    $request->validate([
        'end_date' => ['required', 'date', 'after:' . $employeeworkstatus->start_date],
    ]);

    // Update the end date from the request data
    $employeeworkstatus->end_date = $request->end_date;

    // Save the changes to the database
    if ($employeeworkstatus->save()) {
        return redirect()->route('employeeworkstatuses.index')->with('message', 'Updated successfully.');
    } else {
        return back()->withInput()->withErrors(['An error occurred while updating the employee work status.']);
    }
}

	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		
		return redirect()->route('/employee')->with('exception', 'Operation failed !');
	}

	

}
