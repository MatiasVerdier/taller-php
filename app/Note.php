<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  public function resource()
  {
    return $this->belongsTo(Resource::class);
  }
}
