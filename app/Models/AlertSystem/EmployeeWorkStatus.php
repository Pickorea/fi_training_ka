<?php

namespace App\Models\AlertSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;
use Illuminate\Notifications\Notifiable;

class EmployeeWorkStatus extends Model
{
    use HasFactory, SnoozeNotifiable;

    protected $table = 'employee_work_statuses';
    protected $fillable = ['employee_id', 'start_date', 'end_date'];

    public function employee(){

        return $this->belongsTo(Employee::class);
    }

    // Schedule for a week from now
// $user->notifyAt(new NextWeekNotification, Carbon::now()->addDays(7));

}
