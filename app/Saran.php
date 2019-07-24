<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
  protected $table = 'sarans';
  public $timestamps = false;
	protected $connection='oracle2';
}
