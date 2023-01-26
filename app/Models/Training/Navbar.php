<?php
  
  namespace App\Models\Training;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Navbar extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name', 'route', 'ordering'
    ];
}