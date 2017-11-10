<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\OrderShipped;
use Mail;
use DB;
use Log;
class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Users retrieved successfully';

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
     * @return mixed
     */
    public function handle()
    {
        Log::info("called");
        Mail::to("c.wangui@wizag.biz")

        ->send(new OrderShipped());
    }
}
