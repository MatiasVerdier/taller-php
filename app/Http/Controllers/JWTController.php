<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\User;

class JWTController extends Controller
{
  public function register()
  {
    $data = request(['name', 'email', 'password']);
    
    $this->validate(request(), [
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required'
    ]);
    
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);
    
    $token = JWTAuth::fromUser($user);
    
    return $token;
  }
  
  public function login()
  {
    $credentials = request(['email', 'password']);
    
    try {
      // attempt to verify the credentials and create a token for the user
      if (! $token = JWTAuth::attempt($credentials)) {
          return response()->json(['error' => 'invalid_credentials'], 401);
      }
    } catch (JWTException $e) {
      // something went wrong whilst attempting to encode the token
      return response()->json(['error' => 'could_not_create_token'], 500);
    }
    
    return $token;
  }
  
  public function logout()
  {
    $token = JWTAuth::getToken();
    
    if ($token) {
      JWTAuth::invalidate($token);
    }
  }
}
