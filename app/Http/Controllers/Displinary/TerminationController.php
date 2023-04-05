<?php

namespace App\Http\Controllers\Displinary;
use App\Http\Controllers\Controller;

use App\Models\AlertSystem\Employee;
use App\Models\Displinary\Termination;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class TerminationController extends Controller
{
    public function create(Employee $employee)
    {
        return view('terminations.create', compact('employee'));
    }

    public function store(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'reason' => 'required|string'
        ]);

        $termination = new Termination();
        $termination->fill($validatedData);
        $termination->employee_id = $employee->id;
        $termination->save();

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Termination added successfully.');
    }

    public function edit(Employee $employee, Termination $termination)
    {
        return view('terminations.edit', compact('employee', 'termination'));
    }

    public function update(Request $request, Employee $employee, Termination $termination)
    {
        $validatedData = $request->validate([
            'reason' => 'required|string'
        ]);

        $termination->update($validatedData);

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Termination updated successfully.');
    }

    public function destroy(Employee $employee, Termination $termination)
    {
        $termination->delete();

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Termination deleted successfully.');
    }
}