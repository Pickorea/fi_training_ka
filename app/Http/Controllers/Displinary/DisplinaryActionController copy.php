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
    
        // Check if employee has any previous disciplinary actions
        $previousAction = DisplinaryAction::where('employee_id', $employeeId)
            ->orderByDesc('action_date')
            ->first();
    
        // Check if the action type is suspension before proceeding to create the suspension
        if ($request->input('action_type') === 'suspension') {
            // If employee has a previous reprimand, give them a suspension
            if ($previousAction && $previousAction->action_type == 'reprimand') {
                $disciplinaryAction = new DisplinaryAction();
                $disciplinaryAction->employee_id = $employeeId;
                $disciplinaryAction->action_type = 'suspension';
                $disciplinaryAction->description = $request->input('description');
                $disciplinaryAction->action_date = now();
    
                // Save the new DisplinaryAction to the database to get its id
                $disciplinaryAction->save();
    
                // Create a new suspension record and associate it with the disciplinary action
                $suspension = new Suspension();
                $suspension->displinary_action_id = $disciplinaryAction->id;
                $suspension->days = $request->input('suspension_days');
                $suspension->start_date = now();
                $suspension->end_date = now()->addDays($suspension->days);
                $disciplinaryAction->suspension()->save($suspension);
    
                return redirect()->back()->with('success', 'Employee has received a suspension.');
            }
    
            // If employee has a previous suspension, give them a final warning
            if ($previousAction && $previousAction->action_type == 'suspension' && $previousAction->suspension) {
                // Check if the suspension is still ongoing
                // $daysLeft = $previousAction->suspension->days - $previousAction->suspension->days_served;
                // if ($daysLeft > 0) {
                //     return redirect()->back()->withErrors(["Employee is currently serving a suspension for {$daysLeft} more days."]);
                // }
                // If the suspension is over, give the employee a final warning
                $disciplinaryAction = new DisplinaryAction();
                $disciplinaryAction->employee_id = $employeeId;
                $disciplinaryAction->action_type = 'final warning';
                $disciplinaryAction->description = $request->input('description');
                $disciplinaryAction->action_date = now();
                $disciplinaryAction->save();
    
                $finalWarning = new FinalWarning();
                $finalWarning->employee_id = $employeeId;
                $finalWarning->date = now();
                $finalWarning->description = "Final Warning";
                $finalWarning->save();
    
                return redirect()->back()->with('success', 'Employee has received a final warning.');
            }
    
            // If employee has a previous final warning, don't allow any more disciplinary actions
            if ($previousAction && $previousAction->action_type == 'final warning') {
                return redirect()->back()->withErrors(['Employee has already received a final warning.']);
            }
            // If employee has a previous termination, don't allow any more disciplinary actions
            if ($previousAction && $previousAction->action_type == 'termination') {
                return redirect()->back()->withErrors(['Employee has already been terminated.']);
            }
        }

    // If no previous disciplinary actions, give the employee a reprimand
    $disciplinaryAction = new DisplinaryAction();
    $disciplinaryAction->employee_id = $employeeId;
    $disciplinaryAction->action_type = 'reprimand';
    $disciplinaryAction->description = $request->input('description');
    $disciplinaryAction->action_date = now();
    $disciplinaryAction->save();

    return redirect()->back()->with('success', 'Employee has received a reprimand.');
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