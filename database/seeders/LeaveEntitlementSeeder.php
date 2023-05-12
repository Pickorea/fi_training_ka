<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\JobTitle;
use App\Models\AlertSystem\LeaveEntitlement;

class LeaveEntitlementSeeder extends Seeder
{
    public function run()
    {
        $jobTitles = JobTitle::all();

        foreach ($jobTitles as $jobTitle) {
            if ($jobTitle->level === 'L6') {
                LeaveEntitlement::create([
                    'job_title_id' => $jobTitle->id,
                    'annual_leave_entitlement' => 20,
                    'sick_leave_entitlement' => 10,
                ]);
            } elseif ($jobTitle->level === 'L13') {
                LeaveEntitlement::create([
                    'job_title_id' => $jobTitle->id,
                    'annual_leave_entitlement' => 25,
                    'sick_leave_entitlement' => 12,
                ]);
            } else {
                LeaveEntitlement::create([
                    'job_title_id' => $jobTitle->id,
                    'annual_leave_entitlement' => 15,
                    'sick_leave_entitlement' => 8,
                ]);
            }
        }
    }
}
