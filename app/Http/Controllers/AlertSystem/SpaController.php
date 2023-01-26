<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\Spa;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class SpaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$spas = Spa::all();
			
		return view('alertsystems.spas.index', compact('spas'));
	}

	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$employees = Employee::all()->toArray();
        return view('alertsystems.spas.create')->with('employees',$employees);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		
		$this->validate($request, [
            'file_name' =>'required|mimes:xls,xlsx,pdf|max:4096',
        ]);
     
        $file = $request->file('file_name');
   
        $fileName = time().'.'. $file->getClientOriginalName();
      
      
           $path ='spa';      
            $file->move($path, $fileName);
					
	
					$results = Spa::create([
						'employee_id' => $request['employee_id'],
						'from_date' => $request['from_date'],
						'to_date' => $request['to_date'],
						'path' =>  $path,
						'file_name' =>  $fileName,
					]);


			
				return redirect()->route('spas.index');
	}

	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
	
		$spa = Spa::find($id);

		return view('alertsystems.spas.show')
	        ->with('spa',$spa);

	}

	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		
        $spa = Spa::find($id)->toArray();
		return view('alertsystems.spas.edit')->withSpa($spa);
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id){
        
          $spa = $request->all();
         $data = Spa::find($id)->update($spa);


			return redirect()->route('spa.index')->with('message', 'Updated successfully.');
	
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		
		return redirect()->route('/Spa')->with('exception', 'Operation failed !');
	}

	

}
