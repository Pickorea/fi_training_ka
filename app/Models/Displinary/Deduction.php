<?php

namespace App\Models\Displinary;
use App\Models\AlertSystem\Employee;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'displinary_action_id',
        'amount'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function disciplinaryAction()
    {
        return $this->belongsTo(DisciplinaryAction::class);
    }
}