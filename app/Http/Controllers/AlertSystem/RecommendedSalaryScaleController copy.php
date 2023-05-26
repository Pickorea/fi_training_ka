<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\RecommendedSalaryScalesRepository;
use App\Repositories\AlertSystem\JobTitleRepository;
use App\Models\AlertSystem\Department;
use App\Models\AlertSystem\RecommendedSalaryScale;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class RecommendedSalaryScaleController extends Controller {

	private $recommendedsalaryscales;

	private $jobtitles;



    public function __construct(RecommendedSalaryScalesRepository $recommendedsalaryscales, JobTitleRepository $jobtitles
	)
    {
        $this->recommendedsalaryscales=$recommendedsalaryscales;

		$this->jobtitles=$jobtitles;
      
       
    }

	public function getRecommendedSalaryScalesByJobTitle($job_title_id)
	{
	  $recommendedSalaryScales = RecommendedSalaryScale::select('id', 'name')
		->where('job_title_id', $job_title_id)
		->get()
		->toArray();
	
	  return response()->json(['data' => $recommendedSalaryScales]);
	}
	
	public function getDataTables(Request $request)
	{
		$search = $request->get('search', '');
		if (is_array($search)) {
			$search = $search['value'];
		}
		$query = $this->recommendedsalaryscales->getForDataTable($search);
		$datatables = DataTables::make($query)->make(true);
		return $datatables;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
{
    $recommendedSalaryScales =  $this->recommendedsalaryscales->all();

    return view('alertsystems.recommendedsalaryscale.index', compact('recommendedSalaryScales'));
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
	
		$jobtitles=$this->jobtitles->pluck();
		
	
        return view('alertsystems.recommendedsalaryscale.create')->withjobTitles($jobtitles);
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
	
			$item = $this->recommendedsalaryscales->create($input);

			
				return redirect()->route('recommendedsalaryscales.index');
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
		$recommendedSalaryScales = $this->recommendedsalaryscales->getById($id);

		return view('alertsystems.recommendedsalaryscale.show')
	       ->withjobTitles($jobtitiles);

	}

	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		if (!Auth::user()->can('hr.edit')) {
			abort(403, 'Unauthorized action.');
		}
	
		$jobtitles = $this->jobtitles->pluck('name', 'id');
		$recommendedSalaryScales = $this->recommendedsalaryscales->getById($id);
	
		return view('alertsystems.recommendedsalaryscale.edit')
			->with('jobTitles', $jobtitles)
			->with('recommendedSalaryScales', $recommendedSalaryScales);
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
       
		$item=$this->recommendedsalaryscales->getById($id);
		$this->recommendedsalaryscales->update($item,$request->all()); 
	
       	return redirect()->route('recommendedsalaryscales.index')->with('message', 'Updated successfully.');
	
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
