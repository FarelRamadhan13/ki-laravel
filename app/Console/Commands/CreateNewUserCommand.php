<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateNewUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Untuk membuat user baru';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo 'test 123';
        $this->info('test 123');
    }
}
