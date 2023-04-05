<?php

namespace App\Models\Displinary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    use HasFactory;
    
    protected $fillable = ['start_date', 'end_date', 'reason', 'displinary_action_id','with_pay', 'employee_id'];

    public function disciplinaryAction()
    {
        return $this->belongsTo(DisciplinaryAction::class);
    }
}