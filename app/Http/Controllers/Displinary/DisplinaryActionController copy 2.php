<?php

namespace App\Http\Controllers\Displinary;
use App\Http\Controllers\Controller;

// use App\Repositories\AlertSystem\DepartmentRepository;
use App\Models\AlertSystem\Employee;
use App\Models\Displinary\DisplinaryAction;
use App\Models\Displinary\Termination;
use App\Models\Displinary\Suspension;
use App\Models\Displinary\FinalWarning;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class DisplinaryActionController extends Controller
{
	
	public function index()
{
    $disciplinaryActions = DisplinaryAction::with('employee')->get();
    return view('displinary.displinary-actions.index', compact('disciplinaryActions'));
}
	
	public function create()
	{
		$employees = Employee::all();
		return view('displinary.displinary-actions.create', compact('employees'));
	}
	

    public function store(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $actionType = $request->input('action_type');
    
        // Check if employee has any previous disciplinary actions
        $previousAction = DisplinaryAction::where('employee_id', $employeeId)
            ->orderByDesc('action_date')
            ->first();
    
        // Wrap the creation of disciplinary action and action specific model in a transaction
        DB::beginTransaction();
    
        try {
            // Create the disciplinary action
            $disciplinaryAction = new DisplinaryAction();
            $disciplinaryAction->employee_id = $employeeId;
            $disciplinaryAction->action_type = $actionType;
            $disciplinaryAction->description = $request->input('description');
            $disciplinaryAction->action_date = now();
            $disciplinaryAction->save();
    
            // Create action specific model based on the action type
            switch ($actionType) {
                case 'reprimand':
                    // No specific model needed for reprimand
                    break;
    
                case 'suspension':
                    // If employee has a previous suspension, give them a final warning
                    if ($previousAction && $previousAction->action_type == 'suspension' && $previousAction->suspension) {
                        $finalWarning = new FinalWarning();
                        $finalWarning->displinary_action_id = $disciplinaryAction->id;
                        $finalWarning->employee_id = $employeeId;
                        $finalWarning->date = now();
                        $finalWarning->description = "Final Warning";
                        $finalWarning->save();
                    } else {
                        // Create the suspension
                        $suspension = new Suspension();
                        $suspension->displinary_action_id = $disciplinaryAction->id;
                        $suspension->employee_id = $employeeId;
                        $suspension->days = $request->input('days');
                        $suspension->start_date = $request->input('start_date');
                        $suspension->end_date = $request->input('end_date');
                        $suspension->save();
                    }
                    break;
    
                case 'final warning':
                    // No specific model needed for final warning
                    break;
    
                case 'termination':
                    // Create the termination
                    $termination = new Termination();
                    $termination->displinary_action_id = $disciplinaryAction->id;
                    $termination->employee_id = $employeeId;
                    $termination->termination_date = $request->input('termination_date');
                    $termination->reason = $request->input('reason');
                    $termination->save();
                    break;
    
                default:
                    throw new \Exception('Invalid action type selected');
            }
    
            // Commit the transaction
            DB::commit();
    
            return redirect()->back()->with('success', 'Employee has been ' . $actionType . '.');
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollback();
            return redirect()->back()->withErrors(['An error occurred while creating the disciplinary action. Please try again.']);
        }
    }
    
    

	

public function edit($id)
{
    $disciplinaryAction = DisciplinaryAction::findOrFail($id);
    $employees = Employee::all();
    return view('disciplinary-actions.edit', compact('disciplinaryAction', 'employees'));
}


    public function update(Request $request, DisciplinaryAction $disciplinaryAction)
{
    $employeeId = $disciplinaryAction->employee_id;
    $lastAction = DisciplinaryAction::where('employee_id', $employeeId)
        ->whereIn('action_type', ['reprimand', 'suspension', 'final warning'])
        ->where('id', '<>', $disciplinaryAction->id)
        ->orderByDesc('action_date')
        ->first();

    if ($lastAction && $lastAction->action_type == 'reprimand') {
        // Employee has already been reprimanded, so don't allow another reprimand
        return redirect()->back()->withErrors(['You cannot reprimand an employee who has already received a reprimand.']);
    }

	if ($lastAction && $lastAction->action_type == 'suspension' && now()->lt(Carbon::createFromTimestamp($lastAction->action_date)->addDays(20))) {
        // Employee is still serving a suspension, so don't allow another suspension
        $daysLeft = $lastAction->action_date->diffInDays(now());
        return redirect()->back()->withErrors(["Employee is currently suspended for {$daysLeft} more days."]);
    }

    if ($lastAction && $lastAction->action_type == 'final warning') {
        // Employee has already received a final warning, so don't allow any more disciplinary actions
        return redirect()->back()->withErrors(['Employee has already received a final warning.']);
    }

    $disciplinaryAction->employee_id = $employeeId;
    $disciplinaryAction->action_type = $request->input('action_type');
    $disciplinaryAction->description = $request->input('description');

    if ($disciplinaryAction->action_type == 'reprimand') {
        $disciplinaryAction->save();
    } elseif ($disciplinaryAction->action_type == 'suspension') {
        $disciplinaryAction->action_date = now()->addDays(20);
        $disciplinaryAction->save();
    } elseif ($disciplinaryAction->action_type == 'final warning') {
        $disciplinaryAction->action_date = null;
        $disciplinaryAction->save();
    } else {
        $termination = new Termination();
        $termination->employee_id = $disciplinaryAction->employee_id;
        $termination->reason = 'Terminated for disciplinary reasons';
        $termination->date = now();
        $termination->save();
    }

    return redirect()->route('disciplinary-actions.index');
}

   
}