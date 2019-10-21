<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Catalog extends Model
{
	protected $table = 'catalogs';
	const CREATED_AT = 'precreatedate';
	//protected $connection='oracle';
	public function catalog_ruas()
	{
		return $this->hasMany('App\CatalogRuas','catalogid','id');
	}
	public function collections()
	{
		return $this->hasMany('App\Collection','catalog_id','id');
	}
	public function worksheet()
	{
		return $this->belongsTo('App\Worksheet', 'worksheet_id', 'id');
	}

}
