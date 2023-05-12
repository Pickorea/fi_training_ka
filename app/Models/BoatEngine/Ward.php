<?php

namespace App\Models\BoatEngine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'island_id',
        'boat_engine_count',
    ];

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }
}
