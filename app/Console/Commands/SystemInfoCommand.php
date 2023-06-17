<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SystemInfoCommand extends Command
{
    protected $signature = 'system:info';

    protected $description = 'Display system information';

    public function handle()
    {
        $output = shell_exec("echo 'System Uptime: $(uptime -p), System Boot Time: $(who -b | awk \"{print \$3, \$4}\")'");

        $this->info($output);
    }
}
