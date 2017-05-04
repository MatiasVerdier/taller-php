<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
