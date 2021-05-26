<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'invoices';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'booking_id',
		'customer_id',
		'invoice_no',
		'title',
		'invoice_date',
		'due_date',
		'payment_terms',
		'additional_notes',
		'sub_total',
		'tax',
		'discount',
		'total',
		'amount_paid',
		'balance_due',
		'pdf_file',
		'is_draft',
		'is_cancelled',
		'is_sent',
		'status',
	];

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
	public function user()
	{
		return $this->belongsTo(User::class, 'customer_id');
	}

	public function invoice_items()
	{
		return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
	}
}
