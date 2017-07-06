<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Resource;
use JWTAuth;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('jwt.auth')->except(['userInfo']);
  }
  
  
  /**
   * Display a listing of the resource for a particular user.
   *
   * @return \Illuminate\Http\Response
   */
  public function resources(User $user) {
    // return $user->resources()->with('owner')->orderBy('created_at', 'desc')->get();
    $userResources = $user->resources()->where('visibility', 'PUBLIC');
    
    try {
      $authUser = JWTAuth::parseToken()->authenticate();
      
      if ($user == $authUser) {
        $userResources = $authUser->resources();
        
        $followingResources = Resource::whereHas('owner.followers', function ($query) use ($authUser) {
          return $query->where('id', $authUser->id)->where('visibility', 'SHARED');
        });
        
        return $userResources
          ->with('owner')
          ->union($followingResources)
          ->latest()
          ->get();
      } else {
        return $userResources
          ->with('owner')
          ->latest()
          ->get();
      }
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
      return $userResources->with('owner')->latest()->get();
    }
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
  
  /**
   * Get user profile
   *
   * @return \Illuminate\Http\Response
   */
  public function profile(Request $request) {
    $user = JWTAuth::parseToken()->authenticate();
    
    $result = array(
      'user' => $user,
      'followers' => $user->followers()->get(),
      'following' => $user->following()->get(),
      'resources' => $user->resources()->get(),
    );
    
    return $result;
  }
  
  /**
   * Get user info
   *
   * @return \Illuminate\Http\Response
   */
  public function userInfo(Request $request, User $user) {
    return array(
      'user' => $user,
      'followers' => $user->followers()->get(),
      'following' => $user->following()->get(),
      'resources' => $user->resources()->where('visibility', 'PUBLIC')->count(),
    );
  }
}
