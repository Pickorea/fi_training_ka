<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'work_status_id' => 1,
            'department_id' => 1,
            'job_title_id' => 1,
            'salary_scale_id' => 1,
            'leave_entitlement_id' => 1,
            'present_address' => '123 Main St, Anytown USA',
            'pf_number' => '123456789',
            'joining_date' => '2022-01-01',
            'gender' => 'male',
            'date_of_birth' => '1990-01-01',
            'marital_status' => 'single',
            'picture' => 'https://via.placeholder.com/150',
        ]);

        Employee::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'work_status_id' => 1,
            'department_id' => 1,
            'job_title_id' => 2,
            'salary_scale_id' => 1,
            'leave_entitlement_id' => 1,
            'present_address' => '456 Main St, Anytown USA',
            'pf_number' => '987654321',
            'joining_date' => '2022-01-01',
            'gender' => 'female',
            'date_of_birth' => '1995-01-01',
            'marital_status' => 'married',
            'picture' => 'https://via.placeholder.com/150',
        ]);
    }
}
