<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Mail\ReservationReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for reservations scheduled for tomorrow';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow();

        $reservations = Reservation::where('reservation_date', $tomorrow->toDateString())
            ->where('status', 'confirmed')
            ->get();

        $count = 0;
        foreach ($reservations as $reservation) {
            Mail::to($reservation->customer_email)->send(new ReservationReminder($reservation));
            $count++;
        }

        $this->info("Sent {$count} reminder emails for tomorrow's reservations.");

        return Command::SUCCESS;
    }
}
