<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\Department;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $departments = [
            ['department_name' => 'Sales'],
            ['department_name' => 'IT'],
            ['department_name' => 'Marketing'],
            ['department_name' => 'HR'],
            ['department_name' => 'Operations'],
            ['department_name' => 'Finance'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
