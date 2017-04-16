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
  
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
    
  public function notes()
  {
    return $this->hasMany(Note::class);
  }
  
  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
