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

	public function destroy(Comment $comment)
	{
		// Check if the current user is the author of the comment (so the user cant delete other users comments, duh)
		// Check if the current user is the author of the comment
		if ($comment->user_id !== auth()->user()->id) {
			return response()->json([
				'success' => false,
				'message' => 'You are not authorized to delete this comment.',
			], 403);
		}

		$comment->delete();

		return response()->json([
			'success' => true,
			'message' => 'Comment deleted successfully.',
		]);
	}
}