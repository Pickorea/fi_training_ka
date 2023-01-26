<?php
namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;

use App\Charts\ExpensesChart;
use Illuminate\Http\Request;
class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpensesChart $chart)
    {
        return view('charts.expenses.index', ['chart' => $chart->build()]);   
    }
}