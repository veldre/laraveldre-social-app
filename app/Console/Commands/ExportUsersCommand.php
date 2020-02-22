<?php

namespace App\Console\Commands;

use App\Jobs\ExportUsersJob;
use App\Jobs\UsersJob;
use Illuminate\Console\Command;

class ExportUsersCommand extends Command
{

    protected $signature = 'users:export';

    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
      dispatch(new ExportUsersJob());
    }
}
