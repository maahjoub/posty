<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function AllPost()
    {
        return view('front.all')->with('posts', Post::all());
    }
    public function Show($id)
    {
        return view('front.single')->with('posts', Post::all());
    }
}
