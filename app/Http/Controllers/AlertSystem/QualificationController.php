<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;
use App\Repositories\AlertSystem\QualificationRepository;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class QualificationController extends Controller {


    private $qualifications;

    public function __construct(QualificationRepository $qualifications)
    {
        $this->qualifications= $qualifications;
             
    }

	public function getDataTables(Request $request)
    {
        $search = $request->get('search', '') ;
        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->qualifications->getForDataTable($search);
        $datatables = DataTables::make($query)->make(true);
        return $datatables;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$qualifications = DB::table('qualifications')
		->select('qualifications.qualification_name', 'qualifications.id')
		->get()->toArray();
	
			
		return view('alertsystems.qualifications.index',compact('qualifications'));
	}

	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	        return view('alertsystems.qualifications.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		
		            $input = $request->all();
					// dd($input);
	
			$item = $this->qualifications->create($input);

			
				return redirect()->route('qualification.index');
	}

	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
	
		$qualification = $this->qualifications->getById($id);

		return view('alertsystems.qualifications.show')
	        ->with('qualification',$qualification);

	}

	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

		$qualification = $this->qualifications->getById($id);
   		return view('alertsystems.qualifications.edit')->with('qualification',$qualification);;
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request,  $id){
        
       
		$item=$this->qualifications->getById($id);
		$this->qualifications->update($item,$request->all()); 
	
       	return redirect()->route('qualification.index')->with('message', 'Updated successfully.');
	
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		
		return redirect()->route('/qualification')->with('exception', 'Operation failed !');
	}

	

}
