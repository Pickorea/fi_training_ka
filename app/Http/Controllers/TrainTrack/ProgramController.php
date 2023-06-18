<?php

namespace App\Http\Controllers\TrainTrack;
use App\Http\Controllers\Controller;

use App\Repositories\TrainTrack\CourseRepository;
use App\Models\TrainTrack\Course;
use App\Repositories\TrainTrack\ProgramRepository;
use App\Repositories\AlertSystem\DepartmentRepository;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ProgramController extends Controller {

	private $courses;
	private $programs;
	private $departments;



    public function __construct(
		CourseRepository $courses, 
		ProgramRepository $programs,
		DepartmentRepository $departments
	)

    {
        $this->courses=$courses;
		$this->programs=$programs;
		$this->departments=$departments;
       
    }

	public function getDataTables(Request $request)
    {
        $search = $request->get('search', '');
        $order_by = $request->get('order_by', 'course_id');
        $sort = $request->get('sort', 'asc');
    
        $data = $this->courses->getForDataTable($search, $order_by, $sort);
    
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
	public function index() {

				
		return view('traintracks.programs.index');
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
		$courses = $this->courses->pluck(); 
		
    	$departments = $this->departments->pluck();
		// dd($courses);
        return view('traintracks.programs.create')->with('departments',$departments)->with('courses',$courses);

    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if (!Auth::user()->can('hr.store')) {
			abort(403, 'Unauthorized action.');
		}
	
		if ($request->course_id == 0) {
			$courseData = [
				'title' => $request->title,
				'description' => $request->description,
				'duration' => $request->duration,
			];
	
			$course = $this->courses->create($courseData);
	
				
			$input = [
				'course_id' => $course->course_id,
				'department_id' => $request->department_id,
				'trainer' => $request->trainer,
				'start_date' => $request->start_date,
				'end_date' => $request->end_date,
			];
	
			$program = $this->programs->create($input);
	
			
		} else {
			$input = $request->all();
	
			$program = $this->programs->create($input);
	
			
		}
	
		return redirect()->route('program.index');
	}
	


// public function store(Request $request)
// {
//     if ($request->course_id == 0) {
//         $course = new Course();
//         $course->title = $request->title;
//         $course->description = $request->description;
//         $course->duration = $request->duration;
//         $course->save();
//         $course_id = $request->course_id;
//     } else {
//         $course_id = $request->course_id;
//     }
//     $input = $request->all();
//     $input['course_id'] = $course_id;
//     $program = $this->programs->create($input);

//     return redirect()->route('program.index');
// }

	

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

		return view('traintracks.programs.show')
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

		return view('traintracks.courses.edit')->with('department',$department)
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
