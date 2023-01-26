<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training\TrainingType;
use Illuminate\Support\Str;

class TrainingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

			
			
			['training_name'=>'Fisheries Managment','training_description'=>'Conservation of fisheries resources'],
			['training_name'=>'Seafood Technology','training_description'=>'Healthy seafood handling'],
			['training_name'=>'Boat Engine Maintenance','training_description'=>'Troubleshooting of engine'],
			['training_name'=>'Fisheries Income Diversitification','training_description'=>'Livelihood Improvement through diversitification'],
			['training_name'=>'Safety at Sea','training_description'=>'Sea safety preparedness'],
			['training_name'=>'Community Based Management','training_description'=>'Management of coastal fisheries through a community based awareness '],
		

			
			

        ] ;
        foreach ($data as $obj)
        {
            TrainingType::create($obj);
        }
    }
}
