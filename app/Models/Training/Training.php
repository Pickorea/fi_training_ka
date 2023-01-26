<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Training extends Model
{
    use HasFactory;

    protected $table = 'trainings';
    protected $fillable = ['island_id', 'training_type_id','training_date'];


    public function type(){

        return $this->belongsTo(TrainingType::class);
    }

    public function trainingdetails(){

        return $this->hasMany(TrainingDetail::class);
    }

}
