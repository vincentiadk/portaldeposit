<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  protected $table = 'news';
  public $timestamps = false;
  protected $connection='oracle2';

  public function createdBy()
  {
    return $this->belongsTo('App\User', 'created_by', 'id');
  }

  public function images()
  {
    return $this->belongsTo('App\Galery', 'foreign_id', 'id');
  }
}
