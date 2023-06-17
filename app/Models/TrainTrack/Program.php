<?php

namespace App\Models\TrainTrack;

use App\Models\AlertSystem\Department;
use App\Models\AlertSystem\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';
    protected $primaryKey = 'program_id';

    protected $fillable = [
        'course_id',
        'department_id',
        'trainer',
        'start_date',
        'end_date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function employees()
{
    return $this->belongsToMany(Employee::class, 'employee_program', 'program_id', 'employee_id');
}

}
