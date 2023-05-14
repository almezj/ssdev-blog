<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
	public function store(Request $request, Post $post)
	{
		$request->validate([
			'content' => 'required|min:5',
		]);

		$comment = new Comment();
		$comment->content = $request->input('content');
		$comment->user_id = auth()->user()->id;
		$comment->post_id = $post->id;
		$comment->save();

		return redirect()->back()->with('success', 'Comment added successfully.');
	}

	public function like(Request $request, $commentId)
	{
		$comment = Comment::findOrFail($commentId);

		if ($comment->likes->contains('user_id', auth()->user()->id)) {
			$comment->likes()->where('user_id', auth()->user()->id)->delete();
			$isLiked = false;
		} else {
			$comment->likes()->create(['user_id' => auth()->user()->id]);
			$isLiked = true;
		}

		$likesCount = $comment->likes()->count();

		return response()->json([
			'success' => true,
			'isLiked' => $isLiked,
			'likesCount' => $likesCount,
		]);
	}
}