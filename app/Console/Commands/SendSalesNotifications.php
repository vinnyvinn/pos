<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Log;

class SendSalesNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Notifications';

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
     DB::table('users')->get();  //
     $this->info('SendSalesNotifications:sendemail Cummand Run successfully!');
    }
    public function sendemail()
    {
     DB::table('users')->get();
    }
}
