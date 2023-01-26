<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class TrainingDetail extends Model
{
    use HasFactory;

    protected $table = 'training_details';
    protected $fillable = ['village_id','training_id', 'participant_first_name','participant_last_name','age','gender'];


    public function training(){

        return $this->belongsTo(Training::class,'training_id', 'id');
    }

}
