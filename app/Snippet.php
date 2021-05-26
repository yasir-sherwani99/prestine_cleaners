<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'snippets';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'display',
		'location',
		'code',
		'is_active'
	];
}
