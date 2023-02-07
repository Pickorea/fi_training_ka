<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $fillable = ['department_name'];

    public function employees(){

        return $this->hasMany(Employee::class);
    }

  
}
