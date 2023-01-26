<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Island extends Model
{
    use HasFactory;

    
    protected $table = 'islands';
    protected $fillable = ['island_name'];

    public function villages(){

        return $this->hasMany(Village::class);

    }

    public static $rules = [
        'island_name' => ['required','string','unique:islands'],
    ];

    public static function genderMaleCount(){

        $countMales =  DB::table('islands')
        ->select(DB::raw("count(case when training_details.gender = '1' then '0' end) as male"))
        ->leftJoin('trainings','islands.id','=','trainings.island_id')
        ->leftJoin('training_details','trainings.id','=','training_details.training_id')
        ->get();

            return $countMales;


    }

}
