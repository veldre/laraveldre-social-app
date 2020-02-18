<?php

namespace App\Console\Commands;

use App\Jobs\UsersJob;
use Illuminate\Console\Command;

class UsersCommand extends Command
{

    protected $signature = 'testing:users{count}';


    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $count = $this->argument('count');
        dispatch(new UsersJob($count));
    }
}
