<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comments';
  public $timestamps = false;
	protected $connection='oracle2';
}
