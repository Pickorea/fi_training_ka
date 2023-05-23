<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\RecommendedSalaryScale;
use App\Models\AlertSystem\JobTitle;

class RecommendedSalaryScalesTableSeeder extends Seeder
{
    public function run()
    {
        $jobTitles = JobTitle::all();

        $scales = [
            [
                'name' => ' L11',
                'min_salary' => 2500,
                'max_salary' => 3500,
            ],
            [
                'name' => 'L10',
                'min_salary' => 4500,
                'max_salary' => 5500,
            ],
            [
                'name' => 'L9-7',
                'min_salary' => 7000,
                'max_salary' => 9000,
            ],
        ];

        foreach ($jobTitles as $jobTitle) {
            foreach ($scales as $scale) {
                RecommendedSalaryScale::create([
                    'name' => $scale['name'],
                    'job_title_id' => $jobTitle->id,
                    'recommended_minimum_salary' => $scale['min_salary'],
                    'recommended_maximum_salary' => $scale['max_salary'],
                ]);
            }
        }
    }
}
