<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
        /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'items';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'active'
	];

	/*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function prices()
    {
        return $this->hasMany(Price::class, 'item_id', 'id');
    }
}
