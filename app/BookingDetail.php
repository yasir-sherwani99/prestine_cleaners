<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'booking_details';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'booking_id',
		'furnished',
		'property_type',
		'house_parts',
		'property_inside_design',
		'carpet_service',
		'carpet_house_location',
		'rug_size',
		'upholstery_items',
		'extra_items',
		'carpet_rug_material',
		'furniture_items',
		'furniture_material',
		'furniture_material_others',
		'mattress_size',
		'curtain_size',
		'highest_window_location',
		'window_sides',
		'window_qty',
		'window_others',
		'oven_type',
		'kitchen_accessory',
		'kitchen_items',
		'kitchen_appliances',
		'cleaning_schedule',
		'pets',
		'iron',
		'office_rooms',
	];

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
	public function booking()
	{
		return $this->belongsTo(Booking::class);
	}

}
