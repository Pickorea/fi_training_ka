<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class SalaryScale extends Model
{
    protected $fillable = [
        'job_title_id',
        'name', // add a default value for the name field
        'minimum_salary',
        'maximum_salary',
    ];

    protected $attributes = [
        'name' => 'L3', // set a default value for the name field
    ];

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
