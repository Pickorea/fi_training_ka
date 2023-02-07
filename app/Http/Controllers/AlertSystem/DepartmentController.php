<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\DepartmentRepository;
use App\Models\AlertSystem\Department;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class DepartmentController extends Controller {

	private $departments;



    public function __construct(DepartmentRepository $departments
	)
    {
        $this->departments=$departments;
      
       
    }

	public function getDataTables(Request $request)
    {
        $search = $request->get('search', '') ;
        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->departments->getForDataTable($search);
        $datatables = DataTables::make($query)->make(true);
        return $datatables;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$departments = DB::table('departments')
		->select('departments.id', 'departments.created_at','departments.department_name')
		->get()->toArray();
	
			
		return view('alertsystems.departments.index',compact('departments'));
	}

	  // Fetch records
	  public function getEmployees($departmentid=0){

		// Fetch Employees by Departmentid
		$empData['data'] = Employees::orderby("name","asc")
			 ->select('id','name')
			 ->where('department',$departmentid)
			 ->get();

		return response()->json($empData);

   }
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	
		$departments=$this->departments->pluck();
	
        return view('alertsystems.departments.create')->withDepartments($departments);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		
		            $input = $request->all();
	
			$item = $this->departments->create($input);

			
				return redirect()->route('department.index');
	}

	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
	
		$department = $this->departments->getById($id);

		return view('alertsystems.departments.show')
	        ->with('department',$department);

	}

	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		
        $department = department::find($id)->toArray();
		return view('alertsystems.departments.edit')
		->withdepartment($department);
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request,  $id){
        
       
		$item=$this->departments->getById($id);
		$this->departments->update($item,$request->all()); 
	
       	return redirect()->route('department.index')->with('message', 'Updated successfully.');
	
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		
		return redirect()->route('/department')->with('exception', 'Operation failed !');
	}

	

}
