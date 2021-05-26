<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'bookings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'cleaning_start_time',
		'additional_notes',
		'cleaning_start_date',
		'cleaning_area_post_code',
		'service_id',
		'service_cost',
		'is_booked',
		'is_online',
		'is_active'
	];

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function booking_detail()
	{
		return $this->hasOne(BookingDetail::class, 'booking_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
