<?php

use App\Price;

function getTitle($id)
{
	$item = Price::find($id);

	if (empty($item)) {
		return "Item Not Found";
	}

	return ucwords($item->title);
}