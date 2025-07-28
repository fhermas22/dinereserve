<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to the specified address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        try {
            Mail::raw('Ceci est un email de test depuis DineReserve!', function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email - DineReserve');
            });

            $this->info("Email de test envoyé avec succès à {$email}");
        } catch (\Exception $e) {
            $this->error("Erreur lors de l'envoi de l'email : " . $e->getMessage());
        }
    }
}
