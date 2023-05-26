<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\AlertSystem\EmployeeWorkStatus;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:notification')
            ->daily()
            ->at('00:00')
            ->when(function () {
                $endDate = Carbon::now()->addDays(3);
                $employees = Employee::whereHas('workStatus', function ($query) {
                        $query->where('work_status_name', '!=', 'permanent');
                    })
                    ->whereHas('employeeWorkStatuses', function ($query) use ($endDate) {
                        $query->whereNotNull('start_date')
                              ->whereNotNull('end_date')
                              ->whereDate('end_date', $endDate);
                    })
                    ->get();

                // Check if there are employees who meet the criteria
                $hasEmployees = $employees->count() > 0;

                return $hasEmployees;
            });
        
        // Log the information outside the closure
        $schedule->exec('echo "Scheduled command ran."')
            ->daily()
            ->at('00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
