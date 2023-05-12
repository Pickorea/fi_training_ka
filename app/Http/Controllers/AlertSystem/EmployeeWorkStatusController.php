<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Models\AlertSystem\WorkStatus;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\EmployeeWorkStatus;
use App\Models\AlertSystem\Vacancy;

use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class EmployeeWorkStatusController extends Controller {


    

	public function getDataTables()
    {
        $search = $request->get('search', '') ;
        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->workstatus->getForDataTable($search);
        $datatables = DataTables::make($query)->make(true);
        return $datatables;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		// $employees = DB::table('employees')
		// ->select('employees.name', 'work_status.work_status_name', 'employee_work_statuses.start_date', 'employee_work_statuses.end_date')
		// ->leftJoin('employee_work_statuses','employees.id','=','employee_work_statuses.employee_id')
		// ->leftJoin('work_status','work_status.id','=','employee_work_statuses.work_status_id')
		// ->get();

		$employees =  DB::table('employees')
    ->select(
        'employees.name',
        'work_status.work_status_name',
        'employee_work_statuses.start_date',
        'employee_work_statuses.end_date',
        'employee_work_statuses.unestablished',
        'employee_work_statuses.id',
        'employees.*',
        'departments.department_name',
        'job_titles.name as job_title_name'
        // 'vacancies.type'
    )
    ->leftJoin('work_status', 'work_status.id', '=', 'employees.work_status_id')
    ->leftJoin('employee_work_statuses', 'employee_work_statuses.employee_id', '=', 'employees.id')
    ->leftJoin('vacancies', 'vacancies.id', '=', 'employee_work_statuses.vacancy_id')
    ->leftJoin('job_titles', 'job_titles.id', '=', 'vacancies.job_title_id')
    ->leftJoin('departments', 'departments.id', '=', 'vacancies.department_id')
    ->where(function($query){
        $query->where('work_status.work_status_name', '!=', 'permenant')
              ->orWhere('employee_work_statuses.unestablished', '=', 'unestablished');
    })
    ->whereNotNull('employee_work_statuses.start_date')
    ->whereNotNull('employee_work_statuses.end_date')
    ->get()
    ->toArray();
 
		// $workpermits =EmployeeWorkStatus::where('start_date', '<', now()->addDays(10))->get();
		// dd($workpermits);

		return view('alertsystems.employeeworkstatuses.index')->with('employees',$employees);
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

	$vacancies = Vacancy::all();
    
    return view('alertsystems.employeeworkstatuses.create')
        ->with('workstatuses', $workstatuses)
        ->with('employees', $employees)
        ->with('vacancies', $vacancies);
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
	public function edit($id) {
		if (! Auth::user()->can('hr.edit')) {
            abort(403, 'Unauthorized action.');
        }
		
        $employeeworkstatuses = EmployeeWorkStatus::find($id)->toArray();
		$workstatus = WorkStatus::pluck('work_status_name', 'id')->get();
		$employee = Employee::pluck('employee_name', 'id')->get();

		return view('alertsystems.employeeworkstatuses.edit')
		->with('employeeworkstatuses',$employeeworkstatuses)
		->with('$workstatus',$workstatus)
		->with('employee',$employee);;
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id){

		if (! Auth::user()->can('hr.update')) {
            abort(403, 'Unauthorized action.');
        }
        
          $employeeworkstatuses = $request->all();
         $data = EmployeeWorkStatus::find($id)->update( $woemployeeworkstatusesrkstatuses);


			return redirect()->route('employeeworkstatuses.index')->with('message', 'Updated successfully.');
	
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
