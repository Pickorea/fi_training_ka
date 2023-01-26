<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\WorkStatus;

class WorkStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

			
			
			['work_status_name'=>'Permenant'],
			['work_status_name'=>'Contract'],
			['work_status_name'=>'On Propogation'],
			['work_status_name'=>'Temporary'],
			
		

			
			

        ] ;
        foreach ($data as $obj)
        {
            WorkStatus::create($obj);
        }
    }
}
