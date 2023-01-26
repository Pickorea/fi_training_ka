<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training\Village;
use Illuminate\Support\Str;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

			
			
			['island_id'=>1,'uuid'=>Str::uuid(),'village_name'=>'Kabangaki', 'village_description' =>'Lovely village with friendly people'],
			['island_id'=>1,'uuid'=>Str::uuid(),'village_name'=>'Kariatebike', 'village_description' =>'Peaceful with Love'],
			['island_id'=>1,'uuid'=>Str::uuid(),'village_name'=>'Baretoa', 'village_description' =>'Strong people'],
			['island_id'=>2,'uuid'=>Str::uuid(),'village_name'=>'Ukiangang', 'village_description' =>'Plenty of wind blowing continously'],
			['island_id'=>2,'uuid'=>Str::uuid(),'village_name'=>'Kuma', 'village_description' =>'Fisheries is subtantial'],
			['island_id'=>2,'uuid'=>Str::uuid(),'village_name'=>'Bikaati', 'village_description' =>'A very remote islet'],
            ['island_id'=>3,'uuid'=>Str::uuid(),'village_name'=>'Tamaroa', 'village_description' =>'Beautiful appearance'],
			['island_id'=>3,'uuid'=>Str::uuid(),'village_name'=>'Roreti', 'village_description' =>'Very religious'],
			['island_id'=>4,'uuid'=>Str::uuid(),'village_name'=>'Bubutei', 'village_description' =>'Standing with smoke'],
			['island_id'=>4,'uuid'=>Str::uuid(),'village_name'=>'Tekaranga', 'village_description' =>'Flowing of water in the river'],
			['island_id'=>4,'uuid'=>Str::uuid(),'village_name'=>'Tebangitua', 'village_description' =>'Fancy Culture'],
			['island_id'=>4,'uuid'=>Str::uuid(),'village_name'=>'Aoniman', 'village_description' =>'Creative villagers'],
            ['island_id'=>5,'uuid'=>Str::uuid(),'village_name'=>'Taburao', 'village_description' =>'Frendship'],
			['island_id'=>5,'uuid'=>Str::uuid(),'village_name'=>'Ewena', 'village_description' =>'To jump over'],
			['island_id'=>5,'uuid'=>Str::uuid(),'village_name'=>'Tuarabu', 'village_description' =>'To tell'],
			['island_id'=>6,'uuid'=>Str::uuid(),'village_name'=>'Tewai', 'village_description' =>'Hitting spear'],
			['island_id'=>6,'uuid'=>Str::uuid(),'village_name'=>'Taku', 'village_description' =>'Bend'],
			['island_id'=>6,'uuid'=>Str::uuid(),'village_name'=>'Taungaeaka', 'village_description' =>'Statisfatory Pleasure'],
           
		

			
			

        ] ;
        foreach ($data as $obj)
        {
            Village::create($obj);
        }
    }
}
