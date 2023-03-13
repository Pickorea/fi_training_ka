<?php

namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;

use App\Models\Training\Island;
use Illuminate\Http\Request;
use App\Models\Training\TrainingType;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TrainingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $trainingTypes = TrainingType::all();
        //dd($employees);

        // Pass data to view
        return view('trainingTypes.index', ['trainingTypes' => $trainingTypes]);

        //return 'welcome'; //view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Auth::user()->can('training_type.create')) {
            abort(403, 'Unauthorized action.');
        }

        $trainingTypes = TrainingType::all()->toArray();;
        // dd($islands);
        return view('trainingTypes.create')->withTrainingTypes($trainingTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Auth::user()->can('training_type.store')) {
            abort(403, 'Unauthorized action.');
        }
        $input = [
         
			'training_name'=> $request->training_name,
            'training_description'=> $request->training_description,
        ] ;
        
            $results = TrainingType::create($input);


        return redirect()->route('training_type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Auth::user()->can('training_type.create')) {
            abort(403, 'Unauthorized action.');
        }
        $trainingType = TrainingType::where('id',$id)->firstOrFail();

		return view('trainingTypes.show')
	        ->with('trainingType',$trainingType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Auth::user()->can('training_type.edit')) {
            abort(403, 'Unauthorized action.');
        }
        $trainingType = TrainingType::where('id',$id)->firstOrFail();
		return view('trainingTypes.edit')->withtrainingType($trainingType);
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
        if (! Auth::user()->can('training_type.update')) {
            abort(403, 'Unauthorized action.');
        }
        // $trainingType = $request->all();
     
        $data = TrainingType::find($id)->update($request->all());


           return redirect()->route('training_type.index')->with('message', 'Updated successfully.');
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
