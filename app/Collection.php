<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
	protected $table = 'collections';
	//const CREATED_AT = 'createdate';
	const CREATED_AT = 'createdate';
	// protected $connection='oracle';
	public function worksheet()
	{
		return $this->belongsTo('App\Worksheet', 'worksheet_id', 'id');
	}

	public function catalog()
	{
		return $this->belongsTo('App\Catalog', 'catalog_id', 'id');
	}

	public function master_publisher()
	{
		return $this->belongsTo('App\Master_publisher', 'publisher_id', 'publisher_id');
	}
}
