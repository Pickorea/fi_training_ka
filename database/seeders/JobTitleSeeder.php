<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\JobTitle;
use App\Models\AlertSystem\Department;

class JobTitleSeeder extends Seeder
{
    public function run()
    {
        $departments = Department::all();
        $jobTitles = [
            [
                'name' => 'Sales Manager',
                'department_id' => $departments->where('department_name', 'Sales')->first()->id,
            ],
            [
                'name' => 'Software Developer',
                'department_id' => $departments->where('department_name', 'IT')->first()->id,
            ],
            [
                'name' => 'Marketing Specialist',
                'department_id' => $departments->where('department_name', 'Marketing')->first()->id,
            ],
            [
                'name' => 'HR Coordinator',
                'department_id' => $departments->where('department_name', 'HR')->first()->id,
            ],

            [
                'name' => 'Operations Manager',
                'department_id' => $departments->where('department_name', 'Operations')->first()->id,
            ],

            [
                'name' => 'Accountant',
                'department_id' => $departments->where('department_name', 'Finance')->first()->id,
            ],
        ];

        foreach ($jobTitles as $jobTitle) {
            JobTitle::create($jobTitle);
        }
    }
}
