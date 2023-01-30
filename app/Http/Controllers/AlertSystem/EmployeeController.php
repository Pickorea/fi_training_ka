<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\EmployeeRepository;
use App\Repositories\AlertSystem\WorkStatusRepository;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\WorkStatus;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class EmployeeController extends Controller {

	private $employees;
    private $workstatus;
    //private $lodges;

    public function __construct(EmployeeRepository $employees,
	WorkStatusRepository $workstatus)
    {
        $this->employees=$employees;
        $this->workstatus=$workstatus;
       
    }

	public function getDataTables(Request $request)
    {
        $search = $request->get('search', '') ;
        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->employees->getForDataTable($search);
        $datatables = DataTables::make($query)->make(true);
        return $datatables;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$employees = DB::table('employees')
		->select('employees.id', 'employees.created_at','employees.name', 'employees.age', 'employees.email','work_status.work_status_name')
		->leftJoin('work_status','employees.work_status_id','=','work_status.id')
		->get()->toArray();
	
			
		return view('alertsystems.employees.index',compact('employees'));
	}

	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	
		$workstatus=$this->workstatus->pluck();
	
        return view('alertsystems.employees.create')->withStatus($workstatus);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		
		            $input = $request->all();
	
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
	
		$employee = $this->employees->getById($id);

		return view('alertsystems.employees.show')
	        ->with('employee',$employee);

	}

	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		
        $employee = Employee::find($id)->toArray();
		$workstatus = WorkStatus::all()->toArray();
		return view('alertsystems.employees.edit')
		->withStatus($workstatus)
		->withEmployee($employee);
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request,  $id){
        
       
		$item=$this->employees->getById($id);
		$this->employees->update($item,$request->all()); 
	
       	return redirect()->route('employee.index')->with('message', 'Updated successfully.');
	
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
