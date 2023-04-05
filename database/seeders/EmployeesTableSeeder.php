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
        // Seed your database with employees data
        Employee::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'work_status_id' => 1,
            'department_id' => 1,
            'present_address' => '123 Main St',
            'pf_number' => '123456789',
            'joining_date' => '2022-01-01',
            'gender' => 'M',
            'date_of_birth' => '1990-01-01',
            'marital_status' => '1',
            'picture' => 'default.jpg',
        ]);
        
        Employee::create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'work_status_id' => 1,
            'department_id' => 2,
            'present_address' => '456 Second St',
            'pf_number' => '987654321',
            'joining_date' => '2021-05-01',
            'gender' => 'F',
            'date_of_birth' => '1995-05-01',
            'marital_status' => '2',
            'picture' => 'default.jpg',
        ]);
        
        Employee::create([
            'name' => 'Bob Smith',
            'email' => 'bobsmith@example.com',
            'work_status_id' => 2,
            'department_id' => 3,
            'present_address' => '789 Third St',
            'pf_number' => '456123789',
            'joining_date' => '2020-01-01',
            'gender' => 'M',
            'date_of_birth' => '1985-01-01',
            'marital_status' => '1',
            'picture' => 'default.jpg',
        ]);
        
        // Add as many employees as needed
        
        // You can add more employee data as needed
        
    }
}
