<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = ['name', 'age', 'email', 'work_status_id', 'department_id'];

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

}
