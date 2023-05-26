<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedSalaryScale extends Model
{
    use HasFactory;

    protected $table = 'recommended_salary_scales';
    protected $fillable = [
        'name',
        'job_title_id',
        'recommended_minimum_salary',
        'recommended_maximum_salary'
    ];

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');

    }
}
