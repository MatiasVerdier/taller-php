<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use JWTAuth;

class ResourceController extends Controller
{
  
  public function __construct()
  {
    // $this->middleware('jwt.auth');
  }
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return Resource::where('visibility', 'PUBLIC')->get();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store()
  {
    $data = request(['title', 'type', 'content']);
    
    $this->validate(request(), [
      'title' => 'required',
      'type' => 'required',
      'content' => 'required'
    ]);
    
    $user = JWTAuth::parseToken()->authenticate();
    
    $resource = Resource::create([
        'title' => $data['title'],
        'type' => $data['type'],
        'content' => $data['content'],
        'user_id' => $user['id'],
    ]);
    
    return $resource;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Resource  $resource
   * @return \Illuminate\Http\Response
   */
  public function show(Resource $resource)
  {
    return $resource;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Resource  $resource
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Resource $resource)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Resource  $resource
   * @return \Illuminate\Http\Response
   */
  public function destroy(Resource $resource)
  {
      //
  }
}
