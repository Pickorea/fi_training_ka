<?php

namespace App\Http\Controllers\Displinary;
use App\Http\Controllers\Controller;

// use App\Repositories\AlertSystem\DepartmentRepository;
use App\Models\AlertSystem\Employee;
use App\Models\Displinary\DisplinaryAction;
use App\Models\Displinary\Termination;
use App\Models\Displinary\Suspension;
use App\Models\Displinary\FinalWarning;
use App\Models\Displinary\StoppageOfIncrement;
use App\Models\Displinary\Deduction;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class DisplinaryActionController extends Controller
{
    // protected $employeeId;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->employeeId = Auth::user()->employee_id;
    // }
	
	public function index()
{
    $disciplinaryActions = DisplinaryAction::with('employee')->get();
    return view('displinary.displinary-actions.index', compact('disciplinaryActions'));
}
	
	public function create()
	{
		$employees = Employee::all();
		return view('displinary.displinary-actions.create', [
            'employees' => $employees,
            'displinaryAction' => new DisplinaryAction()
        ])->with('success', 'Employee has been');
        
	}
	

    public function store(Request $request)
    {
        // Step 1: Collect data from the request and set initial variables.
        $debug = $request->all();
        // dd($debug);
        $employeeId = $request->input('employee_id');
        $actionType = $request->input('action_type');
        $severityLevel = null;
    
        // Step 2: Check if employee has any previous disciplinary actions of the same type.
        $previousAction = DisplinaryAction::where('employee_id', $employeeId)
            ->where('action_type', $actionType)
            ->first();
        if ($previousAction) {
            return redirect()->back()->withErrors(['Employee already has a previous ' . $actionType . '.']);
        }
    
        // Step 3: Check severity level of disciplinary action.
        switch ($actionType) {
            case 'reprimand':
                $severityLevel = 'Low';
                break;
            case 'suspension':
                $suspensionType = $request->input('suspension_type');
                if ($suspensionType == 'interim') {
                    $severityLevel = 'High';
                } else {
                    $severityLevel = 'Medium';
                }
                break;
            case 'final warning':
                $severityLevel = 'High';
                break;
            case 'termination':
                $severityLevel = 'Extreme';
                break;
            default:
                throw new \Exception('Invalid action type selected');
        }
    
        // Step 4: Begin a transaction to wrap the creation of disciplinary action and action specific model.
        DB::beginTransaction();
    
        try {
            // Step 5: Create the disciplinary action.
            $disciplinaryAction = new DisplinaryAction();
            $disciplinaryAction->employee_id = $employeeId;
            $disciplinaryAction->action_type = $actionType;
            $disciplinaryAction->description = $request->input('description');
            $disciplinaryAction->action_date = now();
            $disciplinaryAction->severity_level = $severityLevel;
            $disciplinaryAction->save();
    
            // Step 6: Create action specific model based on the action type.
            switch ($actionType) {
                case 'reprimand':
                    // No specific model needed for reprimand
                    break;
                    case 'suspension':
                        $suspensionType = $request->input('suspension_type');
                        if ($suspensionType == 'interim') {
                            $severityLevel = 'High';
                        } else {
                            $severityLevel = 'Medium';
                        }
                        {
                            // Create the suspension
                            $suspension = new Suspension();
                            $suspension->displinary_action_id = $disciplinaryAction->id;
                            $suspension->employee_id = $employeeId;
                            $suspension->start_date = $request->input('start_date');
                            $suspension->end_date = $request->input('end_date');
                            $suspension->reason = $request->input('suspension_reason');
                    
                            switch ($suspensionType) {
                                case '20_days':
                                    $suspension->with_pay = false;
                                    $suspension->days = 20;
                                    break;
                                case 'stoppage_of_increment':
                                    // Create the stoppage of increment
                                    $stoppageOfIncrement = new StoppageOfIncrement();
                                    $stoppageOfIncrement->displinary_action_id = $disciplinaryAction->id;
                                    $stoppageOfIncrement->employee_id = $employeeId;
                                    $stoppageOfIncrement->duration = $request->input('stoppage_duration');
                                    $stoppageOfIncrement->save();
                                    break;
                                case 'interim':
                                    $suspension->with_pay = $request->input('with_pay') == 'yes' ? true : false;
                                    if (!$suspension->with_pay) {
                                        // Deduct salary for interim suspension
                                        $deduction = new Deduction();
                                        $deduction->displinary_action_id = $disciplinaryAction->id;
                                        $deduction->employee_id = $employeeId;
                                        $deduction->amount = 0.5 * $request->input('salary');
                                        $deduction->save();
                                    }
                                    // Here, you can set the suspension days to a default value or leave it as null
                                    $suspension->days = null;
                                    break;
                                default:
                                    // Handle any other cases if needed
                                    break;
                            }
                    
                            $suspension->save();
                        }
                        break;
                    
      
                case 'final warning':
                    // Create the final warning
                    $finalWarning = new FinalWarning();
                    $finalWarning->displinary_action_id = $disciplinaryAction->id;
                    $finalWarning->employee_id = $employeeId;
                    $finalWarning->date = $request->input('final_warning_date');//now();
                    $finalWarning->description = $request->input('final_warning_reason');
                    $finalWarning->save();
                    break;
                    
                case 'termination':
                    // Create the termination
                    $termination = new Termination();
                    $termination->displinary_action_id = $disciplinaryAction->id;
                    $termination->employee_id = $employeeId;
                    $termination->date = $request->input('termination_date');
                    $termination->reason = $request->input('termination_reason');
                    $termination->save();
                    break;
                    
                    
                default:
                    throw new \Exception('Invalid action type selected');
            }
    
                // Step 7: Deduct the appropriate amount from the employee's salary based on the severity level.
                switch ($severityLevel) {
                    // case 'High':
                    //     $deduction = new Deduction();
                    //     $deduction->employee_id = $employeeId;
                    //     $deduction->amount = $request->input('salary') * 0.25;
                    //     $deduction->reason = 'Disciplinary action: ' . $disciplinaryAction->id;
                    //     $deduction->save();
                    //     break;

                    case 'Extreme':
                        $deduction = new Deduction();
                        $deduction->displinary_action_id = $disciplinaryAction->id;
                        $deduction->employee_id = $employeeId;
                        $deduction->amount = $request->input('salary') * 0.50;
                      
                        $deduction->save();
                        break;

                    default:
                        // Do nothing for Low and Medium severity levels
                        break;
                }

                // Step 8: Commit the transaction
                DB::commit();

                return redirect()->back()->with('success', 'Disciplinary action created successfully.');
            } catch (\Exception $e) {
            //     // Step 9: Rollback the transaction and log the error
                DB::rollback();
            //     Log::error($e->getMessage());
                return redirect()->back()->withErrors(['An error occurred while creating the disciplinary action.']);
            }
        }

        public function employeeReport($employeeId, $search = '')
        {
            // Get the employee's name
            $employeeName = Employee::find($employeeId)->name;
        
            // Get all disciplinary actions for the employee
            $disciplinaryActionsQuery = DisplinaryAction::where('employee_id', $employeeId);
        
            // Apply search criteria to the query
            if (!empty($search)) {
                $disciplinaryActionsQuery->where(function ($query) use ($search) {
                    $query->where('action_type', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%');
                });
            }
        
            $disciplinaryActions = $disciplinaryActionsQuery->get();
        
            // Initialize an empty array to store the report data
            $reportData = array();
        
            // Loop through each disciplinary action and add its data to the report
            foreach ($disciplinaryActions as $disciplinaryAction) {
                // Initialize an array to store the action data
                $actionData = array(
                    'action_type' => $disciplinaryAction->action_type,
                    'description' => $disciplinaryAction->description,
                    'action_date' => $disciplinaryAction->action_date
                );
        
                // Get the action-specific model and add its data to the report (if applicable)
                switch ($disciplinaryAction->action_type) {
                    case 'suspension':
                        $suspension = Suspension::where('displinary_action_id', $disciplinaryAction->id)->first();
                        if ($suspension) {
                            $actionData['days'] = $suspension->days;
                            $actionData['start_date'] = $suspension->start_date;
                            $actionData['end_date'] = $suspension->end_date;
                            $actionData['with_pay'] = $suspension->with_pay;
                        }
                        break;
        
                    case 'final warning':
                        $finalWarning = FinalWarning::where('displinary_action_id', $disciplinaryAction->id)->first();
                        if ($finalWarning) {
                            $actionData['date'] = $finalWarning->date;
                            $actionData['reason'] = $finalWarning->description;
                        }
                        break;
        
                    case 'termination':
                        $termination = Termination::where('displinary_action_id', $disciplinaryAction->id)->first();
                        if ($termination) {
                            $actionData['date'] = $termination->date;
                            $actionData['reason'] = $termination->reason;
                        }
                        break;
                        
                    case 'stoppage_of_increment':
                        $stoppageOfIncrement = StoppageOfIncrement::where('displinary_action_id', $disciplinaryAction->id)->first();
                        if ($stoppageOfIncrement) {
                            $actionData['duration'] = $stoppageOfIncrement->duration;
                        }
                        break;
        
                    default:
                        // No action-specific model needed for reprimand
                        break;
                }
        
                // Add the employee name and action data to the report
                $reportData[] = array_merge(['employee_name' => $employeeName], $actionData);
                // dd($reportData);
            }
        
            // Return the report data and search term
            return view('displinary.displinary-actions.report', compact('reportData', 'search', 'employeeName'))->render();
        }
        
    

    

public function edit($id)
{
    $displinaryAction = DisplinaryAction::findOrFail($id);
    $employees = Employee::all();
    return view('displinary.displinary-actions.edit', compact('displinaryAction', 'employees'));
}


public function update(Request $request, $id)
{
    $disciplinaryAction = DisplinaryAction::findOrFail($id);
    $disciplinaryAction->description = $request->input('description');
    $disciplinaryAction->action_date = now();

    // Check if employee has any previous disciplinary actions of the same type
    $previousAction = DisplinaryAction::where('employee_id', $disciplinaryAction->employee_id)
        ->where('action_type', $request->input('action_type'))
        ->where('id', '!=', $disciplinaryAction->id)
        ->first();
    if ($previousAction) {
        return redirect()->back()->withErrors(['Employee already has a previous ' . $request->input('action_type') . '.']);
    }

    // Wrap the creation of disciplinary action and action specific model in a transaction
    DB::beginTransaction();

    try {
        $disciplinaryAction->save();

        // Update action specific model based on the action type
        switch ($request->input('action_type')) {
            case 'reprimand':
                // No specific model needed for reprimand
                break;

            case 'suspension':
                $suspension = Suspension::where('displinary_action_id', $disciplinaryAction->id)->first();
                $suspension->days = $request->input('suspension_days');
                $suspension->start_date = $request->input('start_date');
                $suspension->end_date = $request->input('end_date');
                $suspension->save();
                break;

            case 'final warning':
                $finalWarning = FinalWarning::where('displinary_action_id', $disciplinaryAction->id)->first();
                $finalWarning->date = $request->input('final_warning_date');//now();
                $finalWarning->description = $request->input('final_warning_reason');
                $finalWarning->save();
                break;

            case 'termination':
                $termination = Termination::where('displinary_action_id', $disciplinaryAction->id)->first();
                $termination->date = $request->input('termination_date');
                $termination->reason = $request->input('termination_reason');
                $termination->save();
                // Log::debug('Termination data', ['data' => $termination->toArray()]);
                break;

            default:
                throw new \Exception('Invalid action type selected');
        }

        // Commit the transaction
        DB::commit();

        return redirect()->back()->with('success', 'Disciplinary action has been updated.');
    } catch (\Exception $e) {
        // Rollback the transaction if an error occurs
        DB::rollback();
        return redirect()->back()->withErrors(['An error occurred while updating the disciplinary action. Please try again.']);
    }
}


public function search(Request $request)
{
    $searchQuery = $request->input('search_query');
    $reportData = DB::table('displinary_actions')
        ->where('employee_id', $this->employeeId)
        ->where(function ($query) use ($searchQuery) {
            $query->where('action_type', 'LIKE', '%'.$searchQuery.'%')
                  ->orWhere('action_date', 'LIKE', '%'.$searchQuery.'%');
        })
        ->orderBy('action_date', 'DESC')
        ->get();
    return view('displinary.displinary-actions.report', ['employeeName' => $this->employeeName, 'reportData' => $reportData]);
}

   
}