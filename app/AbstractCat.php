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
}
