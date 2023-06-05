<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Models\AlertSystem\WorkStatus;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\EmployeeWorkStatus;
use App\Models\AlertSystem\RecommendedSalaryScale;
use App\Models\AlertSystem\Vacancy;
use App\Models\AlertSystem\JobTitle;
use App\Repositories\AlertSystem\RecommendedRecommendedSalaryScalesRepository;


use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class EmployeeWorkStatusController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$employees = DB::table('employees')
    ->select(
        'employees.name',
        'work_status.work_status_name',
        'employee_work_statuses.start_date',
        'employee_work_statuses.end_date',
        'employee_work_statuses.unestablished',
        'employee_work_statuses.id',
        'employees.*',
        'departments.department_name',
        'job_titles.name as job_title_name',
        'recommended_salary_scales.name as recommended_salary_scale',
        'recommended_salary_scales.recommended_minimum_salary',
        'recommended_salary_scales.recommended_maximum_salary',
        DB::raw('(CASE WHEN employee_work_statuses.end_date < NOW() THEN "Expired" ELSE "Active" END) AS status'),
        DB::raw('DATEDIFF(employee_work_statuses.end_date, employee_work_statuses.start_date) - (DATEDIFF(employee_work_statuses.end_date, employee_work_statuses.start_date) DIV 7 * 2) - 
                (CASE WHEN WEEKDAY(employee_work_statuses.start_date) = 6 THEN 1 ELSE 0 END) - 
                (CASE WHEN WEEKDAY(employee_work_statuses.end_date) = 5 THEN 1 ELSE 0 END) as day_count')
    )
    ->leftJoin('work_status', 'work_status.id', '=', 'employees.work_status_id')
    ->leftJoin('employee_work_statuses', function($join){
        $join->on('employee_work_statuses.employee_id', '=', 'employees.id')
            ->whereNotNull('employee_work_statuses.start_date')
            ->whereNotNull('employee_work_statuses.end_date');
    })
    ->leftJoin('vacancies', 'vacancies.id', '=', 'employee_work_statuses.vacancy_id')
    ->leftJoin('job_titles', 'job_titles.id', '=', 'vacancies.job_title_id')
    ->leftJoin('departments', 'departments.id', '=', 'vacancies.department_id')
    ->leftJoin('recommended_salary_scales', function($join){
        $join->on('recommended_salary_scales.job_title_id', '=', 'job_titles.id');
    })
    ->where(function($query){
        $query->where('work_status.work_status_name', '!=', 'permanent')
            ->orWhere('employee_work_statuses.unestablished', '=', 'unestablished');
    })
    ->whereNotNull('employee_work_statuses.start_date')
    ->whereNotNull('employee_work_statuses.end_date')
    ->get()
    ->toArray();

	
			$jobTitleName = 'Help Desk'; // Replace 'Your Job Title' with the actual job title name
			$jobTitle = JobTitle::where('name', $jobTitleName)->first();

			if ($jobTitle) {
				$jobTitleId = $jobTitle->id;
			} else {
				// Handle the case when the job title is not found
				$jobTitleId = null; // Or assign a default value, or show an error message
			}

			
	
		return view('alertsystems.employeeworkstatuses.index', compact('employees', 'jobTitleId'));
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

    $workstatuses = WorkStatus::where('work_status_name', '!=', 'permanent')->get();

    $employees = Employee::distinct()
        ->select('employees.name', 'employees.id')
        ->leftJoin('work_status', 'work_status.id', '=', 'employees.work_status_id')
        ->leftJoin('employee_work_statuses', 'employees.id', '=', 'employee_work_statuses.employee_id')
        ->where('work_status.work_status_name', '!=', 'permanent')
        ->get();

    // $jobTitles = JobTitle::all();

    // Retrieve vacancies for the given job title ID
    $vacancies = Vacancy::all();

    // Retrieve RecommendedSalaryScales for the given job title ID
    $salaryScales = RecommendedSalaryScale::all();

    return view('alertsystems.employeeworkstatuses.create')
        ->with('workstatuses', $workstatuses)
        ->with('employees', $employees)
        ->with('vacancies', $vacancies)
        // ->with('jobTitles', $jobTitles)
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

	
					$results = EmployeeWorkStatus::create($input);

			
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
    $employeeWorkStatus = EmployeeWorkStatus::findOrFail($id);
	// dd($employeeWorkStatus->start_date);
    $workstatuses = WorkStatus::where('work_status_name', '!=', 'permanent')->get();
    $employees =Employee::find($id);
    $vacancies = Vacancy::all();
    $jobTitles = JobTitle::all();
    $salaryScales = RecommendedSalaryScale::all();
    
    return view('alertsystems.employeeworkstatuses.edit', [
        'employeeworkstatus' => $employeeWorkStatus,
        'workstatus' => $employeeWorkStatus, // pass the $workstatus variable to the view
        'workstatuses' => $workstatuses,
        'employees' => $employees,
        'vacancies' => $vacancies,
        'jobTitles' => $jobTitles,
        'salaryScales' => $salaryScales,
    ]);
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
