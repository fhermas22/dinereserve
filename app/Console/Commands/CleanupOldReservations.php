<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanupOldReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark old reservations as completed and cleanup cancelled reservations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday();

        // Mark yesterday reservations as completed
        $completedCount = Reservation::where('reservation_date', '<', $yesterday->toDateString())
            ->where('status', 'confirmed')
            ->update(['status' => 'completed']);

        // Delete reservations canceled over 30 days
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $deletedCount = Reservation::where('status', 'cancelled')
            ->where('cancelled_at', '<', $thirtyDaysAgo)
            ->delete();

        $this->info("Marked {$completedCount} reservations as completed.");
        $this->info("Deleted {$deletedCount} old cancelled reservations.");

        return Command::SUCCESS;
    }
}
