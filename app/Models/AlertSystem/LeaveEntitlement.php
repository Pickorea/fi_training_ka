<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class LeaveEntitlement extends Model
{
    protected $fillable = ['job_title_id', 'annual_leave_days'];

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
