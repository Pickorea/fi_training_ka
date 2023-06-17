<?php

namespace App\Http\Controllers\TrainTrack;
use App\Http\Controllers\Controller;

use App\Repositories\TrainTrack\ProgramRepository;
use App\Repositories\AlertSystem\EmployeeRepository;
use App\Models\TrainTrack\EmployeeProgram;
use App\Repositories\TrainTrack\EmployeeProgramRepository;
use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class EmployeeProgramController extends Controller {

	private $programs;
	private $employees;
	// private $employeeprograms;



    public function __construct(
		ProgramRepository $programs,
		EmployeeRepository $employees,
		// EmployeeProgramRepository $employeeprograms
	) {
		$this->programs = $programs;
		$this->employees = $employees;
		// $this->employeeprograms = $employeeprograms;
	}
	

	public function getDataTables(Request $request)
    {
		$search = $request->get('search', '');
		$order_by = $request->get('order_by', 'course_id');
		$sort = $request->get('sort', 'asc');
	
		$data = $this->programs->getForDataTable($search, $order_by, $sort);
    
      // Transform the data to match the desired structure
			$transformedData = [];
			foreach ($data as $item) {
				$program = $item->programs->first(); // Access the first item in the collection
				$programData = $program ? [
					'program_id' => $program->program_id,
					'trainer' => $program->trainer,
				] : null;

				$transformedData[] = [
					'course_id' => $item->course_id,
					'title' => $item->title,
					'description' => $item->description,
					'duration' => $item->duration,
					// Access the related program information
					'program' => $programData,
				];
			}

			// Get the pagination links
			$pagination = $data->links()->render();

			return response()->json([
				'data' => $transformedData,
				'pagination' => $pagination
			]);

    }
    

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// public function index() {

				
	// 	return view('traintracks.programs.index');
	// }

	public function index()
{
	$employeePrograms = DB::table('employee_program')
	->join('employees', 'employee_program.employee_id', '=', 'employees.id')
	->join('programs', 'employee_program.program_id', '=', 'programs.program_id')
	->join('courses', 'programs.course_id', '=', 'courses.course_id')
	->select('employees.name as employee_name', 'courses.title as program_course')
	->get();
	// dd($employeePrograms);

    return view('traintracks.employee_programs.index', compact('employeePrograms'));
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
		$programs = $this->programs->pluck(); 
		
    	$employees = $this->employees->pluck();
		// dd($programs);
        return view('traintracks.employee_programs.create')->with('employees',$employees)->with('programs',$programs);

    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'employee_id' => 'required',
			'program_id' => 'required',
		]);
	
		if (!Auth::user()->can('hr.store')) {
			abort(403, 'Unauthorized action.');
		}
	
		$employeeId = $request->input('employee_id');
		$programIds = $request->input('program_id');

		$employee = $this->employees->getById($employeeId);

		foreach ($programIds as $programId) {
			$employee->programs()->attach($programId);
		}
	
		return redirect()->route('employee_program.index');
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
		$course = $this->programs->getById($id);

		return view('traintracks.employee_programs.show')
	        ->with('course',$course);

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
		
        $program=$this->programs->getById($id);

		return view('traintracks.employee_programs.edit')->with('department',$department)
		->with('program',$program);
        
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
       
		$item=$this->programs->getById($id);
		$this->programs->update($item,$request->all()); 
	
       	return redirect()->route('employee_program.index')->with('message', 'Updated successfully.');
	
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// public function destroy($id) {
		
	// 	return redirect()->route('/department')->with('exception', 'Operation failed !');
	// }

	

}
