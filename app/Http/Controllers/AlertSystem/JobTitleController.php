<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;
use App\Repositories\AlertSystem\DepartmentRepository;
use App\Repositories\AlertSystem\VacancyRepository;
use App\Repositories\AlertSystem\JobTitleRepository;
use App\Repositories\AlertSystem\JobDescriptionRepository;
use App\Models\AlertSystem\JobTitle;
use App\Models\AlertSystem\JobDescription;

use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class JobTitleController extends Controller {

	private $departments;
 
	private $jobtitiles;

	private $vacancy;

	private $jobdescription;

	

	public function __construct(DepartmentRepository $departments, JobTitleRepository $jobtitiles,
	VacancyRepository $vacancy, JobDescriptionRepository $jobdescription)
    {
        $this->departments=$departments;
      
		$this->jobtitiles=$jobtitiles;

		$this->vacancy=$vacancy;

		$this->jobdescription=$jobdescription;

		
       
    }

	

		
		public function getJobTitlesByDepartment($department_id)
			{
				$jobTitles = JobTitle::select('id', 'name')
				->where('department_id', $department_id)
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

		$jobtitles = DB::table('job_titles')
		->join('departments', 'departments.id', '=', 'job_titles.department_id')
		->select('job_titles.id', 'job_titles.created_at', 'job_titles.name', 'departments.department_name')
		->get()
		->toArray();

		return  view('alertsystems.jobtitle.index')->withJobTitles($jobtitles);
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
			
		$departments=$this->departments->pluck();
	
        return view('alertsystems.jobtitle.create')
		->withDepartments($departments)
		;
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		DB::beginTransaction();
	
		try {
			if (! Auth::user()->can('hr.store')) {
				abort(403, 'Unauthorized action.');
			}
	
			// Get all the inputs from the form submission
			$input = $request->all();
	
			// Create a new job title with the input
			$jobTitle = $this->jobtitiles->create($input);
	
			// Get the job descriptions from the input
			$jobDescriptions = $request->input('description',[]);
	
			$descriptions = [];
	
			// Loop through each job description and create an array of JobDescription objects
			foreach ($jobDescriptions as $key => $jobDescription) {
				$descriptions[] = new JobDescription([
					'description' => $jobDescription,
					'job_title_id' => $jobTitle->id,
				]);
			}
	
			// Save the descriptions in the job title
			$jobTitle->jobdescription()->saveMany($descriptions);
	
			DB::commit();
			return redirect()->route('jobtitle.index');
		} catch (Exception $e) {
			DB::rollBack();
			return back()->withError($e->getMessage())->withInput();
		}
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
		
		$jobtitle = $this->jobtitiles->getById($id);
		$jobdescriptions = $jobtitle->jobdescription;
	
		return view('alertsystems.jobtitle.show', compact('jobtitle', 'jobdescriptions'));
	}
	
	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
{
    if (! Auth::user()->can('hr.edit')) {
        abort(403, 'Unauthorized action.');
    }

    $jobTitle = $this->jobtitiles->getById($id);
    $departments = $this->departments->pluck();

    return view('alertsystems.jobtitle.edit')
    ->withJobtitle($jobTitle)
    ->withDepartments($departments);

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
    $jobtitle = JobTitle::findOrFail($id);
    $jobtitle->name = $request->name;
    $jobtitle->department_id = $request->department_id;
    $jobtitle->save();

    $jobdescriptions = $request->description;
    $jobdescriptionsToUpdate = [];
    $jobdescriptionsToCreate = [];

    foreach ($jobdescriptions as $key => $jobdescription) {
        if (isset($jobdescription['id'])) {
            // Job description already exists, add to update array
            $jobdescriptionsToUpdate[$key] = $jobdescription;
        } else {
            // Job description is new, add to create array
            $jobdescriptionsToCreate[$key] = $jobdescription;
        }
    }

    // Update existing job descriptions
    foreach ($jobdescriptionsToUpdate as $key => $jobdescription) {
        $jd = JobDescription::findOrFail($jobdescription['id']);
        $jd->description = $jobdescription['description'];
        $jd->save();
    }

    // Create new job descriptions
    foreach ($jobdescriptionsToCreate as $key => $jobdescription) {
        $jd = new JobDescription;
        $jd->job_title_id = $jobtitle->id;
        $jd->description = $jobdescription['description'];
        $jd->save();

        // Update job description array with new ID
        $jobdescriptions[$key]['id'] = $jd->id;
    }

    // Delete removed job descriptions
    $jobdescriptionsToRemove = $jobtitle->jobdescription->pluck('id')->diff(collect($jobdescriptions)->pluck('id')->filter());
    JobDescription::whereIn('id', $jobdescriptionsToRemove)->delete();

    return redirect()->route('jobtitle.index');
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
 * SELECT department.name , qualifications.qualification_name, schools.school_name, jobtitiles.from_year, jobtitiles.to_year FROM department left JOIN jobtitiles on department.id = jobtitiles.employee_id left join schools on jobtitiles.school_id = schools.id left join qualifications on jobtitiles.qualification_id = qualifications.id
 */