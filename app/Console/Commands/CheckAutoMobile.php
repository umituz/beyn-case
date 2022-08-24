<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckAutoMobile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:automobile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync with the latest car models';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
