class Supplier extends Model
{
use HasFactory;

protected $fillable = [
    'name',
    'contact_person',
    'address',
    'contact_number',
];

public function boats()
{
    return $this->hasMany(Boat::class);
}

public function engines()
{
    return $this->hasMany(Engine::class);
}
}