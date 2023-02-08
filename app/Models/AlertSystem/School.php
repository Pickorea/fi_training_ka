<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    protected $fillable = ['school_name'];

    public function education(){

        return $this->hasMany(Education::class);
    }


}
