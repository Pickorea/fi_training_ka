<?php

namespace App\Http\Controllers\TrainTrack;
use App\Http\Controllers\Controller;

use App\Repositories\TrainTrack\CourseRepository;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class CourseController extends Controller {

	private $courses;



    public function __construct(CourseRepository $courses
	)
    {
        $this->courses=$courses;
      
       
    }

	public function getDataTables(Request $request)
{
    $search = $request->get('search', '');
    $order_by = $request->get('order_by', 'course_id');
    $sort = $request->get('sort', 'asc');

    $courses = $this->courses->getForDataTable($search, $order_by, $sort);

    // Transform the data to match the desired structure
    $transformedData = [];
    foreach ($courses as $course) {
        $transformedData[] = [
            'course_id' => $course->course_id,
            'title' => $course->title,
            'description' => $course->description,
            'duration' => $course->duration,
        ];
    }

    $paginationLinks = $courses->links();

    return response()->json([
        'data' => $transformedData,
        'pagination' => $paginationLinks
    ]);
}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

				
		return view('traintracks.courses.index');
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

        return view('traintracks.courses.create');

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
	
			$item = $this->courses->create($input);

			
				return redirect()->route('course.index');
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
		$course = $this->courses->getById($id);

		return view('traintracks.courses.show')
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
		
        $course=$this->courses->getById($id);

		return view('traintracks.courses.edit')
		->with('course',$course);
        
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
       
		$item=$this->courses->getById($id);
		$this->courses->update($item,$request->all()); 
	
       	return redirect()->route('course.index')->with('message', 'Updated successfully.');
	
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
