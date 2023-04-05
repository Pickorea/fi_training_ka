<?php

namespace App\Http\Controllers\Displinary;
use App\Http\Controllers\Controller;

use App\Models\AlertSystem\Employee;
use App\Models\Displinary\FinalWarning;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class FinalWarningController extends Controller
{
    public function create(Employee $employee)
    {
        return view('final_warnings.create', compact('employee'));
    }

    public function store(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'reason' => 'required|string'
        ]);

        $finalWarning = new FinalWarning();
        $finalWarning->fill($validatedData);
        $finalWarning->employee_id = $employee->id;
        $finalWarning->save();

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Final warning added successfully.');
    }

    public function edit(Employee $employee, FinalWarning $finalWarning)
    {
        return view('final_warnings.edit', compact('employee', 'finalWarning'));
    }

    public function update(Request $request, Employee $employee, FinalWarning $finalWarning)
    {
        $validatedData = $request->validate([
            'reason' => 'required|string'
        ]);

        $finalWarning->update($validatedData);

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Final warning updated successfully.');
    }

    public function destroy(Employee $employee, FinalWarning $finalWarning)
    {
        $finalWarning->delete();

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Final warning deleted successfully.');
    }
}