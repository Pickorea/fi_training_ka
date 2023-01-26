<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Models\Designation;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\WorkStatus;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class EmployeeController extends Controller {

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
			
		return view('alertsystems.employees.index', compact('employees'));
	}

	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$workstatus = WorkStatus::all()->toArray();
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
	
					$results = Employee::create($input);

			
				return redirect()->route('employee.index');
	}

	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
	
		$employee = Employee::find($id);

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
		return view('alertsystems.employees.edit')->withEmployee($employee);
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id){
        
          $employee = $request->all();
         $data = Employee::find($id)->update($employee);


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
