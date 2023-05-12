class EngineType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function engines()
    {
        return $this->hasMany(Engine::class);
    }
}
