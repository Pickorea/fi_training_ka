<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class JobTitle extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'department_id',
    ];
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
{
    return $this->hasMany(Employee::class);
}

public function jobdescription()
{
    return $this->hasMany(JobDescription::class);
}

public function salaryScales()
    {
        return $this->hasMany(SalaryScale::class);
    }

    public function leaveEntitlements()
    {
        return $this->hasMany(LeaveEntitlement::class);
    }

    public function vacancys()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function recommendedSalaryScales()
    {
        return $this->hasMany(RecommendedSalaryScale::class, 'job_title_id');
    }

}
