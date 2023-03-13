<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use App\Repositories\AlertSystem\EmployeeRepository;
use App\Repositories\AlertSystem\WorkStatusRepository;
use App\Models\AlertSystem\Employee;
use App\Models\AlertSystem\WorkStatus;
use DB;
use Artisan;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ArtisanCommandController extends Controller {

	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function RunArtisanCommand()
    {
	
		Artisan::call('send:notification');
	
        return 'Command Excuted';//view('alertsystems.employees.create')->withStatus($workstatus);
    }

	

	

}
