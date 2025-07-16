<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helper\FunctionUtilities;

class CheckUserSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check user subscriptions, send reminders, and deactivate expired accounts.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $utilities = new FunctionUtilities();
        $utilities->checkUserSubscriptions();

        $this->info('User subscriptions checked and processed successfully.');
    }
}
