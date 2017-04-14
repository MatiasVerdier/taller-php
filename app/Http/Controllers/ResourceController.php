<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests\StoreResource;

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
  public function store(StoreResource $request)
  {
    $data = request(['title', 'type', 'description', 'link', 'markdown', 'code']);
    
    $user = JWTAuth::parseToken()->authenticate();
    
    $resource = Resource::create([
        'title' => $data['title'],
        'type' => $data['type'],
        'link' => $data['link'],
        'code' => $data['code'],
        'markdown' => $data['markdown'],
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
