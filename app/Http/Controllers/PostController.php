<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Blog;

class PostController extends Controller
{

    public function index(Blog $blog)
    {
        return response()->json($blog->posts, 200);
    }


    public function store(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $post = $blog->posts()->create($validated);

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        $post->load(['likes', 'comments']);

        return response()->json($post);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'image' => 'nullable|string',
        ]);

        $post->update($validated);

        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
