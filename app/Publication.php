<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
  protected $table = 'publications';
  public $timestamps = false;
	protected $connection='oracle2';
  protected $guarded=[];

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
    return $this->hasMany('App\Galery','foreign_id','id');
  }
}
