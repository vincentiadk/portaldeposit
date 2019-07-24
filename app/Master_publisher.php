<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_publisher extends Model
{
	protected $table = 'master_publisher';
	protected $primaryKey='publisher_id';
	const CREATED_AT = 'create_date';
	public function collections(){
		return $this->hasMany('App\Collection', 'publisher_id', 'publisher_id');
	}
	public function propinsi(){
		return $this->belongsTo('App\Propinsi','region','code');
	}
}
