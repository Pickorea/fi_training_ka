<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\RecommendedSalaryScalesRepository;
use App\Repositories\AlertSystem\JobTitleRepository;
use App\Models\AlertSystem\Department;
use App\Models\AlertSystem\RecommendedSalaryScale;
use DB;
use Yajra\DataTables\Facades\DataTables;
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
    $order_by = $request->get('order_by', 'id');
    $sort = $request->get('sort', 'asc');

    $data = $this->recommendedsalaryscales->getForDataTable($search, $order_by, $sort);

    // Transform the data to match the desired structure
    $transformedData = [];
    foreach ($data as $item) {
        $transformedData[] = [
            'id' => $item->id,
            'job_title' => [
                'id' => $item->jobTitle->id,
                'name' => $item->jobTitle->name,
            ],
            // 'job_title_id' => $item->job_title_id,
            'name' => $item->name,
            'recommended_maximum_salary' => $item->recommended_maximum_salary,
            'recommended_minimum_salary' => $item->recommended_minimum_salary,
        ];
    }

    return response()->json(['data' => $transformedData]);
}
	



	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
			return view('alertsystems.recommendedsalaryscale.index');
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
	       ->with('recommendedSalaryScales',$recommendedSalaryScales);

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
