<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'username', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token', 'created_at', 'updated_at',
  ];
  
  public function resources()
  {
    return $this->hasMany(Resource::class);
  }
  
  public function notes()
  {
    return $this->hasMany(Note::class);
  }
  
  public function tags()
  {
    return $this->hasMany(Tag::class);
  }
  
  public function followers() {
    return $this->belongsToMany(User::class, 'user_follower', 'user_id', 'follower_id')->withTimestamps();
  }
  
  public function following() {
    return $this->belongsToMany(User::class, 'user_follower', 'follower_id', 'user_id')->withTimestamps();
  }
}
