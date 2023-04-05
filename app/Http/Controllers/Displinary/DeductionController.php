<?php

namespace App\Http\Controllers\Displinary;
use App\Http\Controllers\Controller;

use App\Models\Displinary\Deduction;
use App\Models\Displinary\DisciplinaryAction;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class DeductionController extends Controller
{
    public function store(Request $request, DisciplinaryAction $disciplinaryAction)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'reason' => 'required|string'
        ]);

        $deduction = new Deduction();
        $deduction->fill($validatedData);
        $deduction->disciplinary_action_id = $disciplinaryAction->id;
        $deduction->save();

        return redirect()->back()->with('success', 'Deduction added successfully.');
    }

    public function update(Request $request, DisciplinaryAction $disciplinaryAction, Deduction $deduction)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'reason' => 'required|string'
        ]);

        $deduction->update($validatedData);

        return redirect()->back()->with('success', 'Deduction updated successfully.');
    }

    public function destroy(DisciplinaryAction $disciplinaryAction, Deduction $deduction)
    {
        $deduction->delete();

        return redirect()->back()->with('success', 'Deduction deleted successfully.');
    }
}