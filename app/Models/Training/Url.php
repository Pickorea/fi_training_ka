<?php
  
  namespace App\Models\Training;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Url extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name', 'url', 'ordering'
    ];
}