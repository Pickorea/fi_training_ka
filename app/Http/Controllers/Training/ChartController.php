<?php
namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;
use App\Models\Training\Training;

use Illuminate\Support\Facades\DB;

use App\Charts\ExpensesChart;
use Illuminate\Http\Request;
class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = Training::select('islands.island_name as Island', 'villages.village_name as Village', 'trainings.training_date as Date', 'training_types.training_name as Training', 
    DB::raw('count(case when training_details.gender = 1 then 1 end) as Male'), 
    DB::raw('count(case when training_details.gender = 0 then 1 end) as Female'), 
    DB::raw('count(*) as Total'))
    ->leftJoin('islands', 'islands.id', '=', 'trainings.island_id')
    ->leftJoin('training_types', 'training_types.id', '=', 'trainings.training_type_id')
    ->leftJoin('training_details', 'training_details.training_id', '=', 'trainings.id')
    ->leftJoin('villages', 'villages.id', '=', 'training_details.village_id')
    ->groupBy('trainings.training_date', 'islands.island_name', 'villages.village_name', 'training_types.training_name')
    ->get();

    $Male = $result->pluck('Male');
    $Island = $result->pluck('Island');
    // dd($Island, $Male);

        return view('charts.expenses.index', compact('Male', 'Island'));   
    }
}