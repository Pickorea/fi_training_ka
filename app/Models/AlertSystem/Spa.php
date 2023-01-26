<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Spa extends Model
{
    use HasFactory;

    protected $table = 'spas';
    protected $fillable = ['file_name','employee_id','name', 'path', 'from_date', 'to_date'];

    public function employee(){

        return $this->belongsTo(Employee::class);
    }

}
