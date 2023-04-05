<?php

namespace App\Models\Displinary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoppageOfIncrement extends Model
{
    use HasFactory;
    
    protected $table = 'stoppage_of_increments'; // Update with your table name
    
    protected $fillable = [
        'displinary_action_id',
        'employee_id',
        'duration'
    ];

    // Define relationships, if any

    public function disciplinaryAction()
    {
        return $this->belongsTo(DisciplinaryAction::class);
    }
    
}
