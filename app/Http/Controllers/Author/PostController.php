<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
class PostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('Posts.index', compact('posts'));
    }
    public function create()
    {
        return view('Posts.create');
    }
    public function show(Post $post)
    {
        if(Auth::id() != $post->user_id) {
            abort(403);
        }
        return view('Posts.show', compact('post') );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }
        return view('Posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::id() != $post->user_id) {
            //abort(403);
        }
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function test(){
        $results = User::where('created_at', '>', new DateTime('2024-07-14 11:36:34'))->get();
        dd($results);
    }
}
