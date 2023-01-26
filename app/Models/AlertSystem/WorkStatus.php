<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class WorkStatus extends Model
{
    use HasFactory;

    
    protected $table = 'work_status';
    protected $fillable = ['work_status_name'];

    public function employee(){

        return $this->belongsTo(Employee::class);

    }

    public static $rules = [
        'work_status' => ['required','string','unique:work_status'],
    ];

    public function employees(){

        return $this->hasMany(Employee::class);
    }

}
