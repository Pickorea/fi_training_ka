<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'job_title_id',
        // 'type',
      
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function statuses()
    {
        return $this->hasMany(VacancyStatus::class);
    }
    
    public function employeeWorkStatuses()
    {
        return $this->hasMany(EmployeeWorkStatus::class);
    }
    
}
