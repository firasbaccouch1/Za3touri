<?php

namespace App\Console\Commands;

use App\Models\Users\Orders;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveOrdersUnpaidEvery3Days extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:unpiadOrders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will remove the unpaid orders every 3 days';

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
      $orders =  Orders::where([['status','unpaid'],['created_at','<',Carbon::now()->subDay(3)]])->get();
      foreach ($orders as $order) {
        $order->delete();
      }
    }
}
