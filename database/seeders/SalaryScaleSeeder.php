<?php

// database/seeders/SalaryScaleSeeder.php
namespace Database\Seeders;

use App\Models\AlertSystem\JobTitle;
use App\Models\AlertSystem\SalaryScale;
use Illuminate\Database\Seeder;

class SalaryScaleSeeder extends Seeder
{
    public function run()
    {
        $jobTitles = [
            'Sales Manager' => 'L6-5',
            'Software Developer' => 'L8-3',
            'Marketing Specialist' => 'L7-8',
            'HR Coordinator' => 'L5-2',
            'Operations Manager' => 'L9-10',
            'Accountant' => 'L6-12',
        ];

        foreach ($jobTitles as $jobTitleName => $salaryRange) {
            $jobTitle = JobTitle::where('name', $jobTitleName)->first();

            if ($jobTitle) {
                $salaryScale = new SalaryScale;
                $salaryScale->jobTitle()->associate($jobTitle);

                // Split the salary range into minimum and maximum salaries
                [$minimumSalary, $maximumSalary] = explode('-', $salaryRange);
                $salaryScale->minimum_salary = (float) $minimumSalary;
                $salaryScale->maximum_salary = (float) $maximumSalary;

                $salaryScale->save();
            }
        }
    }
}

