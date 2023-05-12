class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ward_id',
        'address',
        'contact_number',
    ];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function boats()
    {
        return $this->hasMany(Boat::class);
    }

    public function engines()
    {
        return $this->hasMany(Engine::class);
    }
}
