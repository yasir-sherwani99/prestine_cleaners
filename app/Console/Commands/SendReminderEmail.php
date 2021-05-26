<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendReminderJob;

use App\Booking;

class SendReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '24 hour prior to service client should receive a reminder email';

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
        $tomorrow = date('Y-m-d', strtotime( '1 days' ));

        $bookings = Booking::where('is_booked', 1)
                        ->whereDate('cleaning_start_date', $tomorrow)
                        ->get();

        if(count($bookings) > 0) 
        {

            foreach($bookings as $booking) 
            {
                dispatch(new SendReminderJob($booking));
            }

        }

        return true;
    }
}
