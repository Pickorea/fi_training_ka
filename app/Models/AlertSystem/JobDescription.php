<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class JobDescription extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'job_title_id'];

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }
}