class Engine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'recipient_id',
        'engine_type_id',
        'supplier_id',
        'quantity',
        'horse_power',
        'date_distributed',
        'status',
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function engineType()
    {
        return $this->belongsTo(EngineType::class);
    }

    public function supplier()
    {
               return $this->belongsTo(Supplier::class);
    }
}

