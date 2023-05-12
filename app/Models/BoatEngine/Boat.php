class Boat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'recipient_id',
        'boat_type_id',
        'supplier_id',
        'quantity',
        'date_distributed',
        'status',
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function boatType()
    {
        return $this->belongsTo(BoatType::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
