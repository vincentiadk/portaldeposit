<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
  protected $table = 'rules';
  public $timestamps = false;
	protected $connection='oracle2';

  public function createdBy(){
  	return $this->belongsTo('App\User', 'created_by', 'id');
  }

  public function updatedBy(){
  	return $this->belongsTo('App\User', 'updated_by', 'id');
  }
}
