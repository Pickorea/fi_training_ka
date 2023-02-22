<?php
// app/Models/Vessel.php
namespace App\Models\VesselRegistration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'village_id',
        'owner_id',
        'island_id',
    ];

    public function village()
    {
        return $this->belongsTo(Village::class,'village_id','id');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function island()
    {
        return $this->belongsTo(Island::class,'owner_id','id');
    }
}