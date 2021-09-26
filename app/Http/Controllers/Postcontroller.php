<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class Postcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $posts = Post::with(['user', 'likes'])->paginate(12);
        return view('posty.index', [
            'posts' => $posts
        ]);
        // return view('posty.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posty.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $filenamewithextension = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
            $request->file('photo')->storeAs('public/image/posts', $filenametostore);

        $this->validate($request, [
            "title"=> 'required',
            "body"=> 'required',
            "photo"=> 'required',
        ]);
        $request->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->body,
            'image' => $filenametostore
        ]);
        session()->flash('success', 'the post has added succesfuly');
        return redirect(route('post.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posty.show')->with('posts', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $posts = Post::find($post);
        return view('posty.create')->with('posts', $posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title"=> 'required',
            "body"=> 'required',
        ]);
        $post = Post::find($id);
        // $post->update($request->all());
        $post->update([
            'title' => $request->title,
            'content' => $request->body,
        ]);
        session()->flash('success', 'the post has updated succesfuly');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('success', 'the post has deleted succesfuly');
        return redirect()->route('post.index');
    }

}
