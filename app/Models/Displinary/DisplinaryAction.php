<?php

namespace App\Models\Displinary;
use App\Models\AlertSystem\Employee;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisplinaryAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'action_type',
        'description',
        'action_date',
        'severity_level',
    ];

    protected $dates = [
        'action_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function suspension()
    {
        return $this->hasOne(Suspension::class);
    }

    public function finalwarning()
    {
        return $this->hasOne(FinalWarning::class);
    }

    public function termination()
    {
        return $this->hasOne(Termination::class);
    }

}