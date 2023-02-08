<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Qualification extends Model
{
    use HasFactory;

    protected $table = 'qualifications';
    protected $fillable = ['qualification_name'];

    public function education(){

        return $this->hasMany(Education::class);
    }


}
