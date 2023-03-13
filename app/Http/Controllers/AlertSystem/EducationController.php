<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\EmployeeRepository;
use App\Repositories\AlertSystem\SchoolRepository;
use App\Repositories\AlertSystem\QualificationRepository;
use App\Repositories\AlertSystem\EducationRepository;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\Education;
use App\Models\AlertSystem\Qualifiction;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class EducationController extends Controller {

	private $employees;
    private $schools;
    private $qualifictions;
	private $educations;

    public function __construct(EmployeeRepository $employees,
	SchoolRepository $schools, QualificationRepository $qualifications,
	EducationRepository $educations)
    {
        $this->employees=$employees;
        $this->schools=$schools;
		$this->qualifications=$qualifications;
		$this->educations=$educations;
       
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
	public function index(Request $request) {

		// $search = $request->get('search', '') ;
        // if (is_array($search)) {
        //     $search = $search['value'];
		// }
		
		$educations = $this->educations->getDataForIndex();
			// dd($educations);

		return  view('alertsystems.educations.index')->withEducations($educations);
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
		$schools=$this->schools->pluck();
		$qualifications=$this->qualifications->pluck();
		// dd($qualifications);
		$employees=$this->employees->pluck();
	
        return view('alertsystems.educations.create')
		->withQualifications($qualifications)
		->withSchools($schools)
		->withEmployees($employees);
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
	
			$item = $this->educations->create($input);

			
				return redirect()->route('education.index');
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
	
		$education = $this->educations->getById($id);

		return view('alertsystems.educations.show')
	        ->with('education',$education);

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
		
		$educations=$this->educations->pluck();
		$qualifications=$this->qualifications->pluck();
		$employees=$this->employees->pluck();
		return view('alertsystems.educations.edit')
		->withQualifications($qualifications)
		->withEducations($educations)
		->withEmployees($employees);
        
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
		$item=$this->educations->getById($id);
		$this->educations->update($item,$request->all()); 
	
       	return redirect()->route('education.index')->with('message', 'Updated successfully.');
	
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		
		return redirect()->route('/education')->with('exception', 'Operation failed !');
	}

	

}
/**
 * SELECT employees.name , qualifications.qualification_name, schools.school_name, educations.from_year, educations.to_year FROM employees left JOIN educations on employees.id = educations.employee_id left join schools on educations.school_id = schools.id left join qualifications on educations.qualification_id = qualifications.id
 */