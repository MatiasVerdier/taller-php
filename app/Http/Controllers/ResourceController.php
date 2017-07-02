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
    $this->middleware('jwt.auth')->only(['store', 'update', 'destroy']);
  }
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $public = Resource::where('visibility', 'PUBLIC');
    
    try {
      $user = JWTAuth::parseToken()->authenticate()->id;
      $publicWhitoutUser = $public->where('user_id', '!=' , $user);
      
      return Resource::whereHas('owner.followers', function ($query) use ($user) {
        return $query->where('id', $user)->where('visibility', 'SHARED');
      })
      ->with('owner')
      ->union($publicWhitoutUser)
      ->latest()
      ->get();
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
      return $public->with('owner')->latest()->get();
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreResource  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreResource $request)
  {
    $data = request(['title', 'type', 'description', 'link', 'markdown', 'code', 'code_type']);
    
    $user = JWTAuth::parseToken()->authenticate();
    
    $resource = Resource::create([
        'title' => $data['title'],
        'type' => $data['type'],
        'link' => $data['link'],
        'code' => $data['code'],
        'code_type' => $data['code_type'],
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
    if ($resource->visibility === 'PUBLIC') {
      return $resource;
    } else {
      try {
        if ($resource->visibility === 'SHARED') {
          $user = JWTAuth::parseToken()->authenticate();
          $isFollower = $resource->owner->followers()->where('follower_id', $user->id)->count() === 1;
          
          if ($resource->owner == $user || $isFollower) {
            return $resource;
          } else {
            return response()->json(['error' => 'insufficient_permissions'], 403);
          }
        } else {
          return response()->json(['error' => 'insufficient_permissions'], 403);
        }
      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['error' => 'insufficient_permissions'], 403);
      }
    }
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
    $user = JWTAuth::parseToken()->authenticate();
    
    if ($resource->owner == $user) {
      $resource->delete();
      return response()->json(['message' => 'successfully_deleted'], 200);
    } else {
      return response()->json(['error' => 'insufficient_permissions'], 403);
    }
  }
  
  /**
   * Update metadata of the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Resource  $resource
   * @return \Illuminate\Http\Response
   */
  public function updateMetadata(Request $request, Resource $resource)
  {
    $videoPublishers = [
      'youtube',
      'vimeo',
      'dailymotion'
    ];
    
    $data = $request->only([
      'title',
      'url',
      'author',
      'date',
      'description',
      'image',
      'publisher',
    ]);
    
    $resource->fill([
      'link_image' => $data['image'],
      'description' => $data['description']
    ]);
    
    if (array_search(strtolower($data['publisher']), $videoPublishers) !== false) {
      $resource->link_type = 'video';
    }
    
    $resource->save();
    
    return $resource;
  }
}
