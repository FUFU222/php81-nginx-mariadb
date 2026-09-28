<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Models\User;

class SendVerificationEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:send-verification-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function __construct()
    {
        return parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $unverifiedUsers = User::whereNull('email_verified_at')->get();

        foreach($unverifiedUsers as $user) {
            Mail::to($user->email)->send(new VerificationEmail($user));
            $this->info('Verification email sent to: ' . $user->email);
        }

        return 0;
    }
}
