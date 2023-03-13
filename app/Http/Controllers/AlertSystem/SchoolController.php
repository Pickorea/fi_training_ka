<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;
use App\Repositories\AlertSystem\EmployeeRepository;
use App\Repositories\AlertSystem\SchoolRepository;
use App\Models\AlertSystem\School;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class SchoolController extends Controller {


    private $schools;

    public function __construct(SchoolRepository $schools)
    {
        $this->schools=$schools;
             
    }

	public function getDataTables(Request $request)
    {
        $search = $request->get('search', '') ;
        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->schools->getForDataTable($search);
        $datatables = DataTables::make($query)->make(true);
        return $datatables;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$schools = DB::table('schools')
		->select('schools.school_name', 'schools.id')
		->get()->toArray();
	
			
		return view('alertsystems.schools.index',compact('schools'));
	}

	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if (! Auth::user()->can('hr.create')) {
            abort(403, 'Unauthorized action.');
        }
	        return view('alertsystems.schools.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		if (! Auth::user()->can('hr.store')) {
            abort(403, 'Unauthorized action.');
        }
		
		            $input = $request->all();
					// dd($input);
	
			$item = $this->schools->create($input);

			
				return redirect()->route('school.index');
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
		$school = $this->schools->getById($id);

		return view('alertsystems.schools.show')
	        ->with('school',$school);

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

		$school = $this->schools->getById($id);
   		return view('alertsystems.schools.edit')->with('school',$school);;
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request,  $id){
        
		if (! Auth::user()->can('hr.update')) {
            abort(403, 'Unauthorized action.');
        }
		$item=$this->schools->getById($id);
		$this->schools->update($item,$request->all()); 
	
       	return redirect()->route('school.index')->with('message', 'Updated successfully.');
	
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		
		return redirect()->route('/school')->with('exception', 'Operation failed !');
	}

	

}
