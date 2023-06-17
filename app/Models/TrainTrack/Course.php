<?php

namespace App\Models\TrainTrack;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Course extends Model
{
    use HasFactory;


    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $fillable = ['title', 'description','duration'];


    public function programs(){

        return $this->hasMany(Program::class, 'course_id');
    }

   
}
