<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store(Request $request, Post $post)
    {
       $like = $post->likes()->create([
            "user_id"=>$request->user()->id,
        ]);
        return response()->json([
            'status' => true,
            'msg' => 'like!',
        ]);


    }

    public function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'unlike!',
        ]);
    }
}
