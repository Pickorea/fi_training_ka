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
        $data = [

			
			
			['department_name'=>'ICT'],
			['department_name'=>'PDD'],
			['department_name'=>'COPORATE'],
			['department_name'=>'KSVA'],
			
		

			
			

        ] ;
        foreach ($data as $obj)
        {
            Department::create($obj);
        }
    }
}
