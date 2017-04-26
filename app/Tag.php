<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  
  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
  
  public function resources()
  {
    return $this->hasMany(Resource::class);
  }
  
  public function notes()
  {
    return $this->hasMany(Note::class);
  }
}
