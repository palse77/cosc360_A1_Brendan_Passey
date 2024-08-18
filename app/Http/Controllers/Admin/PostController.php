<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $posts = Post::with('user')->get()->groupBy('user.name');
        return view('Posts.admin.index', compact('posts'));
    }

    public function create()
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        return view('Posts.admin.create');
    }

    public function show(Post $post)
    {
        // Ensure the user is an admin or the owner of the post
        if (!Auth::user()->admin && Auth::id() != $post->user_id) {
            abort(403, 'Unauthorized access.');
        }

        return view('Posts.admin.show', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Ensure the user is an admin or the owner of the post
        if (!Auth::user()->admin && Auth::id() != $post->user_id) {
            abort(403, 'Unauthorized access.');
        }

        Log::info('Admin editing post: ', ['user_id' => Auth::id(), 'post_id' => $post->id]);
        return view('Posts.admin.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Ensure the user is an admin or the owner of the post
        if (!Auth::user()->admin && Auth::id() != $post->user_id) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Ensure the user is an admin or the owner of the post
        if (!Auth::user()->admin && Auth::id() != $post->user_id) {
            abort(403, 'Unauthorized access.');
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }

    public function test()
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $results = User::where('created_at', '>', new DateTime('2024-07-14 11:36:34'))->get();
        dd($results);
    }
}
