<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;
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
        $posts = Post::with('user')->get()->groupBy('user.name');
        return view('Posts.admin.index', compact('posts'));
    }

    public function create()
    {
        return view('Posts.admin.create');
    }

    public function show(Post $post)
    {
        // Allow access to the post if the user is an admin or the post owner
        
            return view('Posts.admin.show', compact('post'));
        

        // If not an admin and not the post owner, deny access
        
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

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Allow access to edit the post if the user is an admin or the post owner
        Log::info('Admin editing post: ', ['user_id' => Auth::id(), 'post_id' => $post->id]);
            return view('Posts.admin.edit', compact('post'));
        

        // If not an admin and not the post owner, deny access
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Allow access to update the post if the user is an admin or the post owner
        
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);

            $post->update($request->all());

            return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
        }

        // If not an admin and not the post owner, deny access
        
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Allow access to delete the post if the user is an admin or the post owner
        
            $post->delete();

            return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
        

        // If not an admin and not the post owner, deny access
        
    }

    public function test()
    {
        $results = User::where('created_at', '>', new DateTime('2024-07-14 11:36:34'))->get();
        dd($results);
    }
}