<?php

namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;

use App\Models\Training\Island;
use App\Models\Training\Village;
use Illuminate\Http\Request;
use App\Models\Training\Training;
use App\Models\Training\TrainingType;
use App\Models\Training\TrainingDetail;
use DB;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $trainings = DB::table('islands')
        ->select('trainings.id', 'islands.island_name', 'villages.village_name', 'trainings.training_date', 'training_details.participant_first_name', 'training_details.participant_last_name', 'training_details.age', 'training_details.gender', 'training_types.training_name')
        ->leftJoin('trainings','islands.id','=','trainings.island_id')
        ->leftJoin('training_types','trainings.training_type_id','=','training_types.id')
        ->leftJoin('training_details','trainings.id','=','training_details.training_id')
        ->leftJoin('villages','training_details.village_id','=','villages.id')
        ->whereNotNull('trainings.training_type_id')
        ->whereNotNull('training_details.village_id')
        ->get();

        $data['islands'] = Island::get(["island_name", "id"]);

        // Pass data to view
        return view('trainings.index', ['trainings' => $trainings], $data);

        //return 'welcome'; //view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $island_id = $request->input('island_id');
        // dd($island);

        // $island_id = request()->island_id;
        $data['villages'] = Village::where("island_id", $request->island_id)
        ->get(["village_name", "id"]);

        
        $islands = Island::all()->toArray();
        $types =   TrainingType::all()->toArray();
        $villages =   Village::all()->toArray();
        // $villages =   Village::with('island')->where('island_id',$island_id)->get()->toArray();
        
        // dd($types);
        return view('trainings.create',$data)->withIslands($islands)->withTypes($types)->withVillages($villages);
    }

    public function getvillage($id)
    {
            $villages = DB::table("villages")->where("island_id",$id)->pluck("village_name","id");
            return json_encode($villages);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        DB::beginTransaction();
        try {
            $training = new Training();
            $training->island_id = $request->island_id;
            $training->training_type_id = $request->training_type_id;
            $training->training_date = $request->training_date;
            $training->save();

           

            $training->trainingdetails()->create([
                'village_id'=>$request->village_id,
                'participant_first_name'=>$request->participant_first_name,
                'participant_last_name'=>$request->participant_last_name,
                'training_id'=>$request->training_id,
                'age'=>$request->age,
                'gender'=>$request->gender,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return 'something went wrong';
        }

        return redirect()->route('training.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['training'] = DB::table('islands')
        ->select('trainings.id', 'islands.island_name', 'villages.village_name', 'trainings.training_date', 'training_details.participant_first_name', 'training_details.participant_last_name', 'training_details.age', 'training_details.gender', 'training_types.training_name')
        ->leftJoin('trainings','islands.id','=','trainings.island_id')
        ->leftJoin('training_types','trainings.training_type_id','=','training_types.id')
        ->leftJoin('training_details','trainings.id','=','training_details.training_id')
        ->leftJoin('villages','training_details.village_id','=','villages.id')
        ->whereNotNull('trainings.training_type_id')
        ->whereNotNull('training_details.village_id')->where('trainings.id', $id)
        ->get();

		return view('trainings.show',$data);
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
        $islands = Island::all()->toArray();
        $types =   TrainingType::all()->toArray();
        $villages =   Village::all()->toArray();
        $detail = DB::table("trainings")
        ->leftJoin("training_details", function($join){
            $join->on("trainings.id", "=", "training_details.training_id");
        })
        ->select("trainings.id", "trainings.training_date","training_details.participant_first_name", "training_details.participant_last_name", "training_details.age", "training_details.gender", "training_details.village_id")
        ->where("trainings.id", "=", $id)
        ->first();
        // dd($training);

		return view('trainings.edit')
        ->withTraining($training)
        ->withIslands($islands)
        ->withTypes($types)
        ->withVillages($villages)
        ->withDetails($detail);
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
        DB::beginTransaction();
        try {
           
        

            $trainingdetail = TrainingDetail::find($id)->update([
                    'village_id'=>$request->village_id,
                    'participant_first_name'=>$request->participant_first_name,
                    'participant_last_name'=>$request->participant_last_name,
                    'training_id'=>$id,
                    'age'=>$request->age,
                    'gender'=>$request->gender,
                ]);

                $training = Training::find($id)->update([
                    'island_id' => $request->island_id,
                    'training_type_id' => $request->training_type_id,
                    'training_date' => $request->training_date,
                ]);

       

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return 'something went wrong may be you forgot to enter the date';
    }


           return redirect()->route('training.index')->with('message', 'Updated successfully.');
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

//report queries
/**select islands.island_name, villages.village_name, trainings.training_date, training_types.training_name, count(case when training_details.gender = 1 then 1 end) as Male, count(case when training_details.gender = 0 then 1 end) as Female from islands left join trainings on islands.id = trainings.island_id left join training_types on training_types.id = trainings.training_type_id left join training_details on training_details.training_id = trainings.id left join villages on villages.id = training_details.village_id GROUP BY trainings.training_date, islands.island_name, villages.village_name*/
/**select count(*) as total, islands.island_name, villages.village_name, trainings.training_date, training_types.training_name, count(case when training_details.gender = 1 then 1 end) as Male, count(case when training_details.gender = 0 then 1 end) as Female from islands left join trainings on islands.id = trainings.island_id left join training_types on training_types.id = trainings.training_type_id left join training_details on training_details.training_id = trainings.id left join villages on villages.id = training_details.village_id GROUP BY trainings.training_date, islands.island_name, villages.village_name*/
//the correct queries
/**select islands.island_name, villages.village_name, trainings.training_date, training_types.training_name, count(case when training_details.gender = 1 then 1 end) as Male, count(case when training_details.gender = 0 then 1 end) as Female, count(*) as Total from islands left join trainings on islands.id = trainings.island_id left join training_types on training_types.id = trainings.training_type_id left join training_details on training_details.training_id = trainings.id left join villages on villages.id = training_details.village_id GROUP BY trainings.training_date, islands.island_name, villages.village_name, training_types.training_name */