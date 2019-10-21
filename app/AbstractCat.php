<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbstractCat extends Model
{
	protected $table = 'abstracts';
	protected $connection = 'oracle2';

	public function catalog()
	{
		return $this->belongsTo('App\Catalog', 'catalog_id', 'id');
	}

	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by', 'id');
	}

	public function images()
	{
		return $this->hasMany('App\Galery', 'foreign_id', 'id');
	}
}
