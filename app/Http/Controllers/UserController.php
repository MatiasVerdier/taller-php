<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('jwt.auth');
  }
  
  
  /**
   * Display a listing of the resource for a particular user.
   *
   * @return \Illuminate\Http\Response
   */
  public function resources(User $user) {
    return $user->resources()->with('owner')->orderBy('created_at', 'desc')->get();
  }
  
  /**
   * Follow a user
   *
   * @return \Illuminate\Http\Response
   */
  public function follow(Request $request) {
    $user = JWTAuth::parseToken()->authenticate();
    
    $userId = request(['user_id']);
    $user->following()->attach($userId);
    
    return $user->following()->get();
  }
  
  /**
   * Unfollow a user
   *
   * @return \Illuminate\Http\Response
   */
  public function unfollow(Request $request) {
    $user = JWTAuth::parseToken()->authenticate();
    
    $userId = request(['user_id']);
    $user->following()->detach($userId);
    
    return $user->following()->get();
  }
}
