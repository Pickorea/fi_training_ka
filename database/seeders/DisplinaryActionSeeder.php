<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Displinary\DisplinaryAction;
use App\Models\Displinary\Suspension;
use App\Models\Displinary\FinalWarning;
use App\Models\Displinary\Termination;

class DisplinaryActionSeeder extends Seeder
{
    public function run()
    {
        // Create a disciplinary action with a suspension
        $disciplinaryAction1 = DisplinaryAction::create([
            'employee_id' => 1,
            'action_type' => 'suspension',
            'description' => 'Employee was caught stealing office supplies.',
            'action_date' => now(),
        ]);

        Suspension::create([
            'displinary_action_id' => $disciplinaryAction1->id,
            'employee_id' => 1,
            'days' => 20,
            'start_date' => '2022-01-01',
            'end_date' => '2022-01-02',
        ]);

        // Create a disciplinary action with a final warning
        $disciplinaryAction2 = DisplinaryAction::create([
            'employee_id' => 2,
            'action_type' => 'final warning',
            'description' => 'Employee was frequently late to work.',
            'action_date' => now(),
        ]);

        FinalWarning::create([
            'displinary_action_id' => $disciplinaryAction2->id,
            'employee_id' => 2,
            'date' => '2022-02-01',
            'description' => 'Employee was given a final warning for repeated tardiness.',
        ]);

        // Create a disciplinary action with a termination
        $disciplinaryAction3 = DisplinaryAction::create([
            'employee_id' => 3,
            'action_type' => 'termination',
            'description' => 'Employee was caught stealing company funds.',
            'action_date' => now(),
        ]);

        Termination::create([
            'displinary_action_id' => $disciplinaryAction3->id,
            'employee_id' => 3,
            'date' => '2022-03-01',
            'reason' => 'Employee was terminated for embezzlement.',
        ]);
    }
}
