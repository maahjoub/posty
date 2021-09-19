<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
    	$posts = Post::paginate(7);

        return view('welcome',compact('posts'));
    }
}
