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
    public function Show($post)
    {
        $post = Post::find($post);
        return view('front.single')->with('posts', $post);
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->paginate(20);

        // Return the search view with the resluts compacted
        return view('search', compact('posts'));
    }
}
