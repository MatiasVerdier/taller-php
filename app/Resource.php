<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];
    
  public function notes()
  {
    return $this->hasMany(Note::class);
  }
}
