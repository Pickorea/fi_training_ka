<?php

namespace App\Http\Controllers\AlertSystem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SystemInfoController extends Controller
{
    public function index()
    {
        $output = shell_exec("echo 'System Uptime: $(uptime -p), System Boot Time: $(who -b | awk \"{print \$3, \$4}\")'");

        return view('alertsystems.system-info.index', ['output' => $output]);
    }
}