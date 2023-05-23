<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;
use Illuminate\Notifications\Notifiable;

class EmployeeWorkStatus extends Model
{
    use HasFactory, SnoozeNotifiable;
    protected $dates = ['end_date'];

    protected $table = 'employee_work_statuses';

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'vacancy_id',
        'recommended_salary_scale_id',
        'unestablished',
        // 'status',
    ];

    public function employee(){

        return $this->belongsTo(Employee::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }


    public function recommendedSalaryScale()
    {
        if ($this->unestablished == 'unestablished') {
            // return the recommended salary scale for unestablished employees
            return $this->employee->salaryScale->recommended_unestablished_salary;
        } else {
            // return the full salary scale for established employees
            return $this->employee->salaryScale->name;
        }
    }

    public function getStartDateAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getStatusAttribute($value)
    {
        return $value ?: 'Active';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value ?: 'Active';
    }

}
