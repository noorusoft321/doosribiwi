<?php

namespace App\Console\Commands;

use App\Models\CheckReq;
use App\Models\Customer;
use Illuminate\Console\Command;

class FreeCustomersBlockCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'free_customers_block:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Free registration customers block after 3 months + package convert to free after one month';

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
        $customers = Customer::where('email', 'NOT LIKE', "%shaadi.org.pk%")->whereNotNull('package_id')->where('package_expiry_date','<',date('Y-m-d H:i:s'))->get();
        foreach ($customers as $customer) {
            $customer->update([
                'package_id' => NULL,
                'user_package' => 'Free',
                'user_package_color' => NULL,
                'package_expiry_date' => NULL
            ]);
        }
    }
}