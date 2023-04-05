<?php

namespace App\Models\Displinary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'reason', 'disciplinary_action_id'];

    public function disciplinaryAction()
    {
        return $this->belongsTo(DisciplinaryAction::class);
    }
}