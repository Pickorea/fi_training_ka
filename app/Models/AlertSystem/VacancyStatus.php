<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class VacancyStatus extends Model
{
    use HasFactory;

    protected $table = 'vacancy_statuses';
    protected $fillable = ['vacancy_id','status'];

    public function vacancy()
{
    return $this->belongsTo(Vacancy::class);
}


  
}
