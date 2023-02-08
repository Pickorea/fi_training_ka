<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';
    protected $fillable = ['from_year', 'to_year', 'school_id', 'qualification_id', 'employee_id'];

   

    public function employee(){

        return $this->belongsTo(Employee::class);
    }

    public function qualification(){

        return $this->belongsTo(Qualification::class);
    }

    public function school(){

        return $this->belongsTo(School::class);
    }

}
