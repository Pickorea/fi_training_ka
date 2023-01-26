<?php

namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\IslandStoreRequest;
use App\Http\Requests\IslandUpdateRequest;
use App\Models\Training\Island;

use Illuminate\Support\Str;

class IslandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $islands = Island::all();
        //dd($employees);

        // Pass data to view
        return view('islands.index', ['islands' => $islands]);

        //return 'welcome'; //view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('islands.create');
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
            
			'island_name'=> $request->island_name,
        ] ;
            
        
            $results = Island::create($input);


        return redirect()->route('island.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $island = Island::where('id',$uuid)->firstOrFail();

		return view('islands.show')
	        ->with('island',$island);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   $island = Island::where('id',$id)->firstOrFail();
		return view('islands.edit')->withIsland($island);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(IslandUpdateRequest $request, $id)
    {
       
     
        $data = Island::find($id)->update($request->all());


           return redirect()->route('island.index')->with('message', 'Updated successfully.');
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
