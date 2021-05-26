<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Booking;

use App\Mail\ReminderEmail;

use Mail;

class SendReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service_date = $this->booking->cleaning_start_date . ' ' . $this->booking->cleaning_start_time;

        $objBooking = new \stdClass();
        $objBooking->name = ucwords($this->booking->user->name);
        $objBooking->cleaning_start_date = date('d F Y, h:i A', strtotime($service_date));
        $objBooking->service = isset($this->booking->service->title) ? $this->booking->service->title : 'Service Unknown';
        $objBooking->cleaning_area = $this->booking->cleaning_area_post_code;

        $client_email = $this->booking->user->email;

        try {

            Mail::to($client_email)->send(new ReminderEmail($objBooking));

        } catch(\Exception $e) {
            
            echo $e->getMessage();

        }
    }
}
