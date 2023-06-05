<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;
use App\Http\Requests\ViewRequest;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\IslandStoreRequest;
use App\Http\Requests\IslandUpdateRequest;
use App\Models\AlertSystem\WorkStatus;
use App\Repositories\AlertSystem\WorkStatusRepository;
use Illuminate\Support\Facades\Auth;

use DataTables;

use Illuminate\Support\Str;

class WorkStatusController extends Controller
{

    private $workstatus;


    public function __construct(
	WorkStatusRepository $workstatus)
    {
  
        $this->workstatus=$workstatus;
       
    }

    public function getDataTables(Request $request)
{
    $search = $request->get('search', '');
    $order_by = $request->get('order_by', 'id');
    $sort = $request->get('sort', 'asc');
    $per_page = $request->get('per_page', 5); // Number of items per page

    $data = $this->workstatus->getForDataTable($search, $order_by, $sort, false, $per_page);

    // Transform the data to match the desired structure
    $transformedData = [];
    foreach ($data as $item) {
        $transformedData[] = [
            'id' => $item->id,
            'work_status_name' => $item->work_status_name,
            'created_at' => $item->created_at->format('Y-m-d'),
        ];
    }

    return response()->json(['data' => $transformedData, 'meta' => [
        'current_page' => $data->currentPage(),
        'last_page' => $data->lastPage(),
        'per_page' => $data->perPage(),
        'total' => $data->total(),
    ]]);
}

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
   
        return view('alertsystems.workstatus.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Auth::user()->can('hr.create')) {
            abort(403, 'Unauthorized action.');
        }
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
        if (! Auth::user()->can('hr.store')) {
            abort(403, 'Unauthorized action.');
        }
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
        if (! Auth::user()->can('hr.show')) {
            abort(403, 'Unauthorized action.');
        }
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
        if (! Auth::user()->can('hr.edit')) {
            abort(403, 'Unauthorized action.');
        }
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
       
        if (! Auth::user()->can('hr.update')) {
            abort(403, 'Unauthorized action.');
        }
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
