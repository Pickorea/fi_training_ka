<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\School;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

			
			
			['school_name'=>'University of The South Pacific'],
			['school_name'=>'University of Auckland'],
			['school_name'=>'University of Tasmania'],
			['school_name'=>'University of Canada'],
			['school_name'=>'King George and EBS'],
			['school_name'=>'Morini High School'],
		

			
			

        ] ;
        foreach ($data as $obj)
        {
            School::create($obj);
        }
    }
}
