<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return response()->json([
            'data' => $posts,
            'message' => 'success'


        ], 200);
    }

    public function show($id)
{
    // Find the post by its ID
    $post = Post::find($id);

    // Check if the post exists
    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }

    // Return the post as a JSON response
    return response()->json($post);
}
}


