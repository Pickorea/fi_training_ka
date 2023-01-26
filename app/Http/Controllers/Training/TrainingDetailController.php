<?php


namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;

use App\Models\Training\Island;
use Illuminate\Http\Request;
use App\Models\Training\Training;
use App\Models\Training\TrainingDetail;
use App\Models\Training\TrainingType;

class TrainingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $trainings = TrainingDetail::all();
        //dd($employees);

        // Pass data to view
        return view('training_details.index', ['trainings' => $trainings]);

        //return 'welcome'; //view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $islands = Island::all()->toArray();
        $types =   TrainingType::all()->toArray();
        // dd($types);
        return view('training_details.create')->withIslands($islands)->withTypes($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = $request->all();
        
            $results = Training::create($input);


        return redirect()->route('training_detail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training_details = TrainingDetail::find($id);

		return view('training_details.show')
	        ->with('training',$training_details);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = Training::find($id);
		return view('training_details.edit')->withTraining($training);
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
        // $Training = $request->all();
     
        $data = Training::find($id)->update($request->all());


           return redirect()->route('training_detail.index')->with('message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
