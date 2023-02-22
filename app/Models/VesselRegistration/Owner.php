<?php
// app/Models/Owner.php
namespace App\Models\VesselRegistration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'email',
    ];

    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }
}