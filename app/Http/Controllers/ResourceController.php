<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests\StoreResource;
use App\Http\Requests\UpdateResource;

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
    return Resource::where('visibility', 'PUBLIC')->with('owner')->latest()->get();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreResource  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreResource $request)
  {
    $data = request(['title', 'visibility', 'type', 'description', 'link', 'markdown', 'code', 'code_type']);
    
    $user = JWTAuth::parseToken()->authenticate();
    
    $resource = Resource::create([
        'title' => $data['title'],
        'visibility' => $data['visibility'],
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
        $user = JWTAuth::parseToken()->authenticate();
        $isFollower = $resource->owner->followers()->where('follower_id', $user->id)->count() === 1;
        $isOwner = $resource->owner == $user;
        
        if ($isOwner || ($resource->visibility === 'SHARED' && $isFollower)) {
          return $resource;
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
  public function update(UpdateResource $request, Resource $resource)
  {
    $user = JWTAuth::parseToken()->authenticate();
    $data = request(['title', 'description', 'link', 'markdown', 'code', 'code_type', 'visibility']);
    
    if ($resource->owner == $user) {
      $resource->title = $data['title'];
      $resource->visibility = $data['visibility'] ?: $resource->visibility;
      $resource->description = $data['description'];
      $resource->link = $data['link'];
      $resource->markdown = $data['markdown'];
      $resource->code = $data['code'];
      $resource->code_type = $data['code_type'];
      
      $resource->save();
      
      return $resource;
    } else {
      return response()->json(['error' => 'insufficient_permissions'], 403);
    }
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
