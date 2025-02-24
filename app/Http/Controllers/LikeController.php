<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, $postId)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
        ]);

        $userId = $validated['user_id'];

        // Check if the user already liked the post
        $existingLike = Like::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($existingLike) {
            return response()->json(['message' => 'You have already liked this post'], 400);
        }

        $like = Like::create([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);

        return response()->json(['message' => 'Post liked successfully', 'like' => $like], 201);
    }
}
