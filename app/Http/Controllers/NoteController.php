<?php

namespace App\Http\Controllers;

use App\Note;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNote;
use JWTAuth;

class NoteController extends Controller
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
  public function index(Resource $resource)
  {
    if ($resource->visibility == 'PUBLIC') {
      return $resource->notes()->get();
    } else {
      try {
        $user = JWTAuth::parseToken()->authenticate();
        $isFollower = $resource->owner->followers()->where('follower_id', $user->id)->count() === 1;
        $isOwner = $resource->owner == $user;
        
        if ($isOwner || ($resource->visibility === 'SHARED' && $isFollower)) {
          return $resource->notes()->get();
        } else {
          return response()->json(['error' => 'insufficient_permissions'], 403);
        }
      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['error' => 'insufficient_permissions'], 403);
      }
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreNote $request, Resource $resource)
  {
    $data = request(['body']);
    $user = JWTAuth::parseToken()->authenticate();
    
    if ($resource->owner != $user) return response()->json(['error' => 'insufficient_permissions'], 403);
    
    $note = Note::create([
      'body' => $data['body'],
      'resource_id' => $resource['id'],
      'user_id' => $user['id'],
    ]);
    
    return $note;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function show(Resource $resource, Note $note)
  {
    if ($note->resource != $resource)
      return response()->json(['error' => 'bad_request'], 400);
      
    return $note;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Resource $resource, Note $note)
  {
    $user = JWTAuth::parseToken()->authenticate();
    $data = request(['body']);
    
    if ($resource->owner == $user) {
      $note->body = $data['body'];
      $note->save();
      return $note;
    } else {
      return response()->json(['error' => 'insufficient_permissions'], 403);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function destroy(Resource $resource, Note $note)
  {
    if ($note->resource != $resource)
      return response()->json(['error' => 'bad_request'], 400);
      
    $user = JWTAuth::parseToken()->authenticate();
    if ($resource->owner == $user) {
      $note->delete();
      return response()->json(['message' => 'successfully_deleted'], 200);
    } else {
      return response()->json(['error' => 'insufficient_permissions'], 403);
    }
  }
}
