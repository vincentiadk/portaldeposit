<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
  protected $table = 'galeries';
  public $timestamps = false;
	protected $connection='oracle2';
}
