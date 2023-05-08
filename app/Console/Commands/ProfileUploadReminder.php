<?php

namespace App\Console\Commands;

use App\Services\ClientService;
use Illuminate\Console\Command;

class ProfileUploadReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will remind any user without a profile image every three days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Profile upload notificaion started");
        $message = (new ClientService)->profileUploadReminder();
        $this->info($message);
    }
}
