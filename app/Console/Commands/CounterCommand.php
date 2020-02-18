<?php

namespace App\Console\Commands;

use App\Jobs\CounterJob;
use Illuminate\Console\Command;

class CounterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social-network:counter{count}';

    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
       $count = $this->argument('count');
//       var_dump('count is ' . $count);
        dispatch(new CounterJob($count));
    }
}
