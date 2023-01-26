<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\IslandStoreRequest;
use App\Http\Requests\IslandUpdateRequest;
use App\Models\AlertSystem\WorkStatus;

use Illuminate\Support\Str;

class WorkStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $workstatus = WorkStatus::all();
        //dd($employees);

        // Pass data to view
        return view('alertsystems.workstatus.index', ['workstatus'=>$workstatus]);

        //return 'welcome'; //view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alertsystems.workstatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = [
            
			'work_status_name'=> $request->work_status_name,
        ] ;
            
        
            $results = WorkStatus::create($input);


        return redirect()->route('work_status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workstatus = WorkStatus::where('id',$id)->firstOrFail();

		return view('alertsystems.workstatus.show')
	        ->with('workstatus',$workstatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   $workstatus = WorkStatus::where('id',$id)->firstOrFail();
		return view('alertsystems.workstatus.edit')->withWorkstatus($workstatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
     
        $data = WorkStatus::find($id)->update($request->all());


           return redirect()->route('work_status.index')->with('message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
