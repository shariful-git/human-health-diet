<?php

namespace App\Console\Commands;

use App\Models\AuditLog;
use Illuminate\Console\Command;

class PruneAuditLogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:prune {--days=90 : Number of days of audit logs to retain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune audit logs older than a specified number of days';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $days = (int) $this->option('days');
        if ($days <= 0) {
            $this->error('The --days option must be a positive integer.');
            return Command::FAILURE;
        }

        $cutoffDate = now()->subDays($days);
        $count = AuditLog::where('created_at', '<', $cutoffDate)->delete();

        $this->info("Successfully pruned {$count} audit log record(s) older than {$days} days (before {$cutoffDate->toDateTimeString()}).");

        return Command::SUCCESS;
    }
}
