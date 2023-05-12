class BoatType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function boats()
    {
        return $this->hasMany(Boat::class);
    }
}
