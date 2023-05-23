<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\EmployeeRepository;
use App\Repositories\AlertSystem\WorkStatusRepository;
use App\Repositories\AlertSystem\DepartmentRepository;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\SalaryScale;
use App\Models\AlertSystem\WorkStatus;
use App\Models\AlertSystem\Department;
use App\Repositories\AlertSystem\JobTitleRepository;
use App\Repositories\AlertSystem\SalaryScaleRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class EmployeeController extends Controller {

	private $employees;
    private $workstatus;
    private $departments;
	private $jobtitle;
	private $salaryscales;

    public function __construct(EmployeeRepository $employees,
	WorkStatusRepository $workstatus, DepartmentRepository $departments, JobTitleRepository $jobtitle, SalaryScaleRepository $salaryscales)
    {
        $this->employees=$employees;
        $this->workstatus=$workstatus;
		$this->departments=$departments;
		$this->jobtitle=$jobtitle;
		$this->salaryscales=$salaryscales;
    }

	public function getEmployeesJobTitles($employee_id)
	{
		$jobTitles = DB::table('job_titles')
			->join('employees', 'job_titles.id', '=', 'employees.job_title_id')
			->where('employees.id', $employee_id)
			->select('job_titles.id', 'job_titles.name')
			->get()
			->toArray();
	
		return response()->json(['data' => $jobTitles]);
	}
	
	


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
	
		$employees = DB::table('employees')
        ->select(
            'employees.id',
            'employees.created_at',
            'employees.name',
            'employees.email',
            'employees.pf_number',
            'employees.joining_date',
            'employees.gender',
            'employees.date_of_birth',
            'employees.marital_status',
            'work_status.work_status_name',
            'job_titles.name as job_title_name' // updated alias
        )
        ->leftJoin('work_status', 'employees.work_status_id', '=', 'work_status.id')
        ->leftJoin('job_titles', 'employees.job_title_id', '=', 'job_titles.id')
        ->get()
        ->toArray();

	
			// dd($employees);
		return view('alertsystems.employees.index',compact('employees'));
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
	
		$workstatus = $this->workstatus->pluck();
		$departments = $this->departments->pluck();
		$jobTitles = $this->jobtitle->pluck();
	
		// Get all salary scales
		$salaryScales = app(SalaryScaleRepository::class)->all();
	
		// Create the $data array using the retrieved data
		$data = [        'jobTitles' => $jobTitles,        'salaryScales' => $salaryScales,    ];
	
		return view('alertsystems.employees.create', $data)
			->withData($data)
			->withDepartments($departments)
			->withStatus($workstatus);
	}
	
	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if (!Auth::user()->can('hr.store')) {
			abort(403, 'Unauthorized action.');
		}
	
		$request->validate([
			'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:16384',
		]);
	
		$input = $request->all();
	
		if ($picture = $request->file('picture')) {
			// Move the uploaded file to a permanent location
			$profilePicture = date('YmdHis') . "." . $picture->getClientOriginalExtension();
			$picture->move(public_path('uploads/employees'), $profilePicture);
			// Set the filename in the $input array
			$input['picture'] = "$profilePicture";
		}
	
		// Set the salary_scale_id based on the selected job title's salary scale
		$jobTitleId = $input['job_title_id'];
		$salaryScale = SalaryScale::where('job_title_id', $jobTitleId)->first();
		if ($salaryScale) {
			$input['salary_scale_id'] = $salaryScale->id;
			$input['minimum_salary'] = $salaryScale->minimum_salary;
			$input['maximum_salary'] = $salaryScale->maximum_salary;
		}
	
		$item = $this->employees->create($input);
	
		return redirect()->route('employee.index');
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

		if (! Auth::user()->can('hr.show')) {
            abort(403, 'Unauthorized action.');
        }
	
		// $employee = $this->employees->getById($id);
		$employee = Employee::select('employees.name', 'employees.picture', 'employees.email', 'employees.present_address', 'employees.pf_number', 'employees.joining_date', 'employees.gender', 'employees.date_of_birth', 'employees.marital_status', 'departments.department_name', 'work_status.work_status_name', 'educations.from_year', 'educations.to_year', 'qualifications.qualification_name', 'schools.school_name')
		->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
		->leftJoin('work_status', 'employees.work_status_id', '=', 'work_status.id')
		->leftJoin('educations', 'educations.employee_id', '=', 'employees.id')
		->leftJoin('qualifications', 'educations.qualification_id', '=', 'qualifications.id')
		->leftJoin('schools', 'educations.school_id', '=', 'schools.id')->where('employees.id', $id)->first();
	// dd($employee);
		return view('alertsystems.employees.show')
	        ->with('employee',$employee);

	}

	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
{
    if (!Auth::user()->can('hr.edit')) {
        abort(403, 'Unauthorized action.');
    }

    $status = $this->workstatus->pluck();
    $departments = $this->departments->pluck();
    $jobTitles = $this->jobtitle->pluck();

    // Get all salary scales
    $salaryScales = app(SalaryScaleRepository::class)->all();

    // Retrieve the employee by id
    $employee = $this->employees->find($id)->first();

    // Create the $data array using the retrieved data
    $data = [
        'employee' => $employee,
        'jobTitles' => $jobTitles,
        'departments' => $departments,
        'status' => $status,
        'salaryScales' => $salaryScales,
    ];

    return view('alertsystems.employees.edit', $data);
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
		if (!Auth::user()->can('hr.update')) {
			abort(403, 'Unauthorized action.');
		}
	
		$request->validate([
			'picture' => 'image|mimes:jpeg,png,jpg,gif|max:16384',
		]);
	
		$item = $this->employees->findOrFail($id);
		$input = $request->all();
	
		if ($picture = $request->file('picture')) {
			// Move the uploaded file to a permanent location
			$profilePicture = date('YmdHis') . "." . $picture->getClientOriginalExtension();
			$picture->move(public_path('uploads/employees'), $profilePicture);
			// Set the filename in the $input array
			$input['picture'] = $profilePicture;
		}
	
		// Set the salary_scale_id based on the selected job title's salary scale
		$jobTitleId = $input['job_title_id'];
		$salaryScale = SalaryScale::where('job_title_id', $jobTitleId)->first();
		if ($salaryScale) {
			$input['salary_scale_id'] = $salaryScale->id;
			$input['minimum_salary'] = $salaryScale->minimum_salary;
			$input['maximum_salary'] = $salaryScale->maximum_salary;
		}
	
		// Instead of directly updating the $item model, use the fill() method
		// to update the attributes and save() method to persist the changes.
		$item->fill($input);
		$item->save();
	
		return redirect()->route('employee.index');
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
/**
 * Select employees.name, employees.picture, employees.email, employees.present_address, employees.pf_number, employees.joining_date, employees.gender, employees.date_of_birth, employees.marital_status, departments.department_name,work_status.work_status_name, educations.from_year,educations.to_year, qualifications.qualification_name, schools.school_name from employees left join departments on employees.department_id = departments.id left join work_status on work_status.id = employees.work_status_id left join educations on educations.employee_id = employees.id left join qualifications on educations.qualification_id = qualifications.id left join schools on educations.school_id = schools.id
 */