<?php

namespace App\Models\Displinary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalWarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'displinary_action_id',
        'date',
        'description',
        'employee_id'
    ];

    protected $dates = [
        'date',
    ];

    public function disciplinaryAction()
    {
        return $this->belongsTo(DisplinaryAction::class, 'displinary_action_id');
    }
}