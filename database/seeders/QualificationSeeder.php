<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertSystem\Qualification;
use Illuminate\Support\Str;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

			
			
			['qualification_name'=>'Masters in Marine Science'],
			['qualification_name'=>'Bachelor of Science'],
			['qualification_name'=>'Bachelor of Art in Education'],
			['qualification_name'=>'Form Serven Certificate'],
			['qualification_name'=>'Bachelor of Art majoring in Ocean Resource Management'],
			['qualification_name'=>'Diploma in Silent Treament'],
		

			
			

        ] ;
        foreach ($data as $obj)
        {
            Qualification::create($obj);
        }
    }
}
