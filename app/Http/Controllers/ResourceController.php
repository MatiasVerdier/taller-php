<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use Validator;
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
  public function store(Request $request)
  {
    $data = request(['title', 'type', 'description', 'link', 'markdown', 'code']);
    
    $validator = Validator::make($data, [
      'title' => 'required',
      'type' => 'required',
      'link' => 'url|required_if:type,LINK',
      'markdown' => 'required_if:type,MARKDOWN',
      'code' => 'required_if:type,CODE',
    ]);
    
    if ($validator->fails()) {    
      return response()->json(['errors' => $validator->messages()], 422);
    }
    
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
