<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = [
        'name',
        'email', 
        'work_status_id',
        'department_id',
        'job_title_id',
        'present_address',
        'pf_number',
        'joining_date',
        'gender',
        'date_of_birth',
        'marital_status',
        'picture',
        'salary_scale_id', 
        'leave_entitlement_id'
    ];
   
    public function employeeworkstatuses(){

        return $this->hasMany(EmployeeWorkStatus::class);
    }

    public function workstatus(){

        return $this->belongsTo(WorkStatus::class);
    }

    public function department(){

        return $this->belongsTo(Department::class);
    }

    public function education(){

        return $this->belongsTo(Education::class);
    }

    public function disciplinaryActions()
    {
        return $this->hasMany(DisciplinaryAction::class);
    }

    public function hasReprimand()
{
    return $this->disciplinaryActions()->where('action_type', 'reprimand')->exists();
}

public function hasSuspension()
{
    return $this->disciplinaryActions()->where('action_type', 'suspension')->exists();
}

public function jobTitle()
{
    return $this->belongsTo(JobTitle::class);
}

public function salaryScale()
{
    return $this->belongsTo(SalaryScale::class);
}

public function leaveEntitlement()
{
    return $this->belongsTo(LeaveEntitlement::class);
}

}
