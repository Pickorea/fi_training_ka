<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;
use App\Notifications\WorkStatusAlert;
use Illuminate\Notifications\Notifiable;

use App\Models\Designation;
use App\Models\AlertSystem\Employee;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class NotifyController  extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		if (! Auth::user()->can('hr.index')) {
            abort(403, 'Unauthorized action.');
        }

		$employees = Employee::select('email')->get();
		// User::find(1)->notify(new WorkStatusAlert);
			\Notification::route('mail', $employees)->notify(new WorkStatusAlert);
		return view('alertsystems.employees.index', compact('employees'));
	}

	

}
