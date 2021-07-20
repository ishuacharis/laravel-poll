<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class HelloCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'greet:hello {user=wale}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Greeting User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = $this->withProgressBar(User::all(), function($user){
            print($user);
        });
        //return 0;
    }
}
