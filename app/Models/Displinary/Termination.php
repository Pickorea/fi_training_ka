<?php

namespace App\Models\Displinary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'reason', 'displinary_action_id'];

    public function disciplinaryAction()
    {
        return $this->belongsTo(DisciplinaryAction::class);
    }
}