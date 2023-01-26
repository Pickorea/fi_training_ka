<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class TrainingType extends Model
{
    use HasFactory;

    protected $table = 'training_types';
    protected $fillable = ['training_name', 'training_description'];

    public function trainings(){

        return $this->hasMany(Training::class);
    }


}
