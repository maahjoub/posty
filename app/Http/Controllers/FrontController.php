<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function AllPost()
    {
        $posts = Post::paginate(12);
        return view('front.all', [
            'posts' => $posts
        ]);
    }
    public function Show(Post $post)
    {
        return view('front.single')->with('posts', $post);
    }
}
