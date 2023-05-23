<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;
use App\Repositories\AlertSystem\DepartmentRepository;
use App\Repositories\AlertSystem\VacancyRepository;
use App\Repositories\AlertSystem\VacancyStatusRepository;
use App\Repositories\AlertSystem\JobTitleRepository;
use App\Models\AlertSystem\Vacancy;
use App\Models\AlertSystem\JobTitle;
use App\Models\AlertSystem\Department;

use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class VacancyController extends Controller {

	private $departments;
 
	private $jobtitiles;

	private $vacancy;

	private $status;

    public function __construct(DepartmentRepository $departments, JobTitleRepository $jobtitiles,
	VacancyRepository $vacancy, VacancyStatusRepository $status)
    {
        $this->departments=$departments;
      
		$this->jobtitiles=$jobtitiles;

		$this->vacancy=$vacancy;

		$this->status=$status;
       
    }

		public function getJobTitleByVacancy($job_title_id)
	{
		$vacancies = Vacancy::select('vacancies.id', 'job_titles.name as job_title_name', 'departments.department_name as department_name')
			->join('job_titles', 'job_titles.id', '=', 'vacancies.job_title_id')
			->join('departments', 'departments.id', '=', 'job_titles.department_id')
			->where('vacancies.job_title_id', $job_title_id)
			->get()
			->toArray();

		return response()->json(['data' => $vacancies]);
	}

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// VacancyController.php

public function index()
{
    $vacancies = Vacancy::with(['department', 'jobTitle', 'statuses'])->get();


    return view('alertsystems.vacancy.index', ['vacancies' => $vacancies]);
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
		$jobtitiles=$this->jobtitiles->pluck();
	// dd($jobtitiles);
        return view('alertsystems.vacancy.create')
		->withDepartments($departments)
		->withJobTitles($jobtitiles);
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
	
		$item = $this->vacancy->create($input);

			if ($item == null) {
				$id = DB::connection()->getPdo()->lastInsertId();

				$vacancy = $this->vacancy->getById($id);

				$this->status->create([
					'vacancy_id' => $vacancy->id,
					'status' => $request->input('status'),
				]);

				return redirect()->route('vacancy.index');
			} else {
				throw new \Exception("Failed to create vacancy.");
			}
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
	
		$vacancy = $this->vacancy->getById($id);
		// dd($vacancy);
	
		if (!$vacancy) {
			abort(404, 'Vacancy not found.');
		}
	
		$department = $this->departments->getById($id);
		$statuses = $this->status->getById($id);

		$vacancyStatuses = [
			1 => 'Open',
			2 => 'Filled',
			3 => 'Closed'
		];
	
		return view('alertsystems.vacancy.show')
        ->with('vacancy',$vacancy)
        ->with('department',$department)
        ->with('vacancyStatuses', $vacancyStatuses)
		->with('statuses', $statuses);

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
		
	
		$departments=$this->departments->pluck();
		return view('alertsystems.vacancy.edit')
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
				if (!Auth::user()->can('hr.update')) {
					abort(403, 'Unauthorized action.');
				}

				$input = $request->all();

				$vacancy = $this->vacancy->getById($id);

				if (!$vacancy) {
					throw new \Exception("Vacancy not found.");
				}

				$result = $this->vacancy->update($id, $input);

				if ($result) {
					$this->status->create([
						'vacancy_id' => $id,
						'status' => $request->input('status'),
					]);

					return redirect()->route('vacancy.index');
				} else {
					throw new \Exception("Failed to update vacancy.");
				}
			}


			public function updateStatus(Request $request, $id)
			{
				$_id = intval($id);
				// dd($_id);
				$status = $this->status->getById($_id);
				// dd($status);
				if (!$status) {
					return redirect()->back()->with('error', 'Vacancy Status not found!');
				}
			
				$this->status->updateStatus($status, $request->input('status'));
				return redirect()->route('vacancy.index')->with('success', 'Vacancy Status status updated successfully!');
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
