<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;


use App\Repositories\AlertSystem\JobTitleRepository;

use App\Repositories\AlertSystem\SalaryScaleRepository;

use App\Models\AlertSystem\SalaryScale;
// use App\Models\AlertSystem\JobDescription;

use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class SalaryScaleController extends Controller {

 
	private $jobtitiles;


	private $salaryscales;

	

	public function __construct(JobTitleRepository $jobtitiles, SalaryScaleRepository $salaryscales )   
	 {
     
		$this->jobtitiles=$jobtitiles;
		$this->salaryscales=$salaryscales;

    }

	
	
		public function getSalaryScalesByJobTitle($job_title_id)
		{
			$salaryScales = SalaryScale::select('id', 'name')
				->where('job_title_id', $job_title_id)
				->get()
				->toArray();

			return response()->json(['data' => $salaryScales]);
		}

		
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$salaries = DB::table('job_titles')
		->join('salary_scales', 'salary_scales.job_title_id', '=', 'job_titles.id')
		->select('job_titles.id', 'job_titles.created_at', 'job_titles.name', 'salary_scales.minimum_salary', 'salary_scales.maximum_salary','salary_scales.name as salary_level')
		->get()
		->toArray();
	

		return  view('alertsystems.salaryscale.index')->withsalaryScales($salaries);
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
			
		$jobTitles = app(JobTitleRepository::class)->pluck();
		// dd($jobTitles);
	
		return view('alertsystems.salaryscale.create')->withJobTitles($jobTitles);
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

		$item = $this->salaryscales->create($input);

		
			return redirect()->route('salaryscales.index');
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
		
		$salaryscales = $this->salaryscales->getById($id);
		// $jobdescriptions = $jobtitle->jobdescription;
	
		return view('alertsystems.salaryscale.show', compact('salaryscales'));
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

    $salaryScale =  $this->salaryscales->getById($id);
    $jobTitles = app(JobTitleRepository::class)->pluck();

    return view('alertsystems.salaryscale.edit', compact('salaryScale', 'jobTitles'));
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
       
		$item=$this->salaryscales->getById($id);
		$this->salaryscales->update($item,$request->all()); 
	
       	return redirect()->route('salaryscales.index')->with('message', 'Updated successfully.');
	
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
