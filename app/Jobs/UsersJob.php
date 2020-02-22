<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function handle()
    {
        factory(User::class, $this->count)->create(); // factory neder ja vajag parbaudit īstus eventus vajadzēja ar faker
    }


}
