<?php

namespace App\Http\Controllers\Displinary;
use App\Http\Controllers\Controller;

use App\Models\AlertSystem\Employee;
use App\Models\Displinary\Suspension;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class SuspensionController extends Controller
{
    public function create(Employee $employee)
    {
        return view('suspensions.create', compact('employee'));
    }

    public function store(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required|string'
        ]);

        $suspension = new Suspension();
        $suspension->fill($validatedData);
        $suspension->employee_id = $employee->id;
        $suspension->save();

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Suspension added successfully.');
    }

    public function edit(Employee $employee, Suspension $suspension)
    {
        return view('suspensions.edit', compact('employee', 'suspension'));
    }

    public function update(Request $request, Employee $employee, Suspension $suspension)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required|string'
        ]);

        $suspension->update($validatedData);

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Suspension updated successfully.');
    }

    public function destroy(Employee $employee, Suspension $suspension)
    {
        $suspension->delete();

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Suspension deleted successfully.');
    }
}