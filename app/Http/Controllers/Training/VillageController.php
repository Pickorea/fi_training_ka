<?php

namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;

use App\Models\Training\Island;
use Illuminate\Http\Request;
use App\Models\Training\Village;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $villages = Village::all();
        //dd($employees);

        // Pass data to view
        return view('villages.index', ['villages' => $villages]);

        //return 'welcome'; //view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if the authenticated user has permission to create a new village
        if (! Auth::user()->can('village.create')) {
            abort(403, 'Unauthorized action.');
        }

        $islands = Island::all()->toArray();
        // dd($islands);
        return view('villages.create')->withIslands($islands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if the authenticated user has permission to create a new village
        if (! Auth::user()->can('village.store')) {
            abort(403, 'Unauthorized action.');
        }
        $input = [
             'island_id'=> $request->island_id,
			'village_name'=> $request->village_name,
            'village_description'=> $request->village_description,
        ] ;
        
            $results = village::create($input);


        return redirect()->route('village.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $village = village::where('id',$id)->firstOrFail();
       
		return view('villages.show')
	        ->with('village',$village);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // Check if the authenticated user has permission to edit a village
         if (! Auth::user()->can('villages.edit')) {
            abort(403, 'Unauthorized action.');
        }
        $village = village::where('id',$id)->firstOrFail();
        $islands = Island::all()->toArray();
      
		return view('villages.edit')->withVillage($village)
        ->withIslands($islands);
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
        // $village = $request->all();
         // Check if the authenticated user has permission to update a village
         if (! Auth::user()->can('village.update')) {
            abort(403, 'Unauthorized action.');
        }
     
        $data = Village::find($id)->update($request->all());


           return redirect()->route('village.index')->with('message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  Check if the authenticated user has permission to delete a village
        // if (! Auth::user()->can('villages.delete')) {
        //     abort(403, 'Unauthorized action.');
        // }
    }
}
