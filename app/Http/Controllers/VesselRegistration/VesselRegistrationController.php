<?php

namespace App\Http\Controllers\VesselRegistration;
use App\Http\Controllers\Controller;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\IslandStoreRequest;
use App\Http\Requests\IslandUpdateRequest;
use App\Models\VesselRegistration\Island;
use App\Models\VesselRegistration\Village;
use App\Models\VesselRegistration\Vessel;
use App\Models\VesselRegistration\Owner;

use Illuminate\Support\Str;

class VesselRegistrationController extends Controller
{
    public function index()
    {
           
      
        $vessels = Vessel::with('village', 'owner', 'island')->get();
       
        return view('vesselRegistration.vessel.index', compact('vessels'));
         }

    public function getIsland(Village $village)
        {
            $island = $village->island;
            return $island->island_name;
        }


    public function create()
    {
        $villages = Village::all();
        $islands = Island::all();
        $owners = Owner::all();

        return view('vesselRegistration.vessel.create', compact('villages', 'islands', 'owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'registration_number' => 'required',
            'village_id' => 'required|exists:villages,id',
            'owner_id' => 'nullable|exists:owners,id',
            'island_id' => 'required|exists:islands,id',
        ]);
    
        // Check if the owner exists in the database
        if ($request->has('owner_id')) {
            $owner = Owner::findOrFail($request->owner_id);
        } else {
            // Create a new owner record
            $owner = Owner::create([
                'name' => $request->owner_name,
                // 'email' => $request->email,
            ]);
        }
    
        // Create a new vessel registration record
        $vesselRegistration = Vessel::create([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'village_id' => $request->village_id,
            'owner_id' => $owner->id,
            'island_id' => $request->island_id,
        ]);
    
        return redirect()->route('vessel-registrations.index');
    }
    

    public function edit(Vessel $vessel)
    {
        $villages = Village::all();
        $islands = Island::all();

        return view('vesselRegistration.vessel.edit', compact('vessel', 'villages', 'islands'));
    }

    public function update(Request $request, Vessel $vessel)
    {
        $validated = $request->validate([
            'vessel_name' => 'required|max:255',
            'village_id' => 'required',
            'owner_name' => 'required|max:255',
            'island_id' => 'required',
        ]);

        $village = Village::findOrFail($validated['village_id']);
        $owner = Owner::firstOrCreate(['name' => $validated['owner_name']]);
        $island = Island::findOrFail($validated['island_id']);

        $vessel->name = $validated['vessel_name'];
        $vessel->village()->associate($village);
        $vessel->owner()->associate($owner);
        $vessel->island()->associate($island);
        $vessel->save();

        return redirect()->route('vesselRegistration.vessel.index');
    }

    public function destroy(Vessel $vessel)
    {
        $vessel->delete();

        return redirect()->route('vesselRegistration.vessel.index');
    }
}