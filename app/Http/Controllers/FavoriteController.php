<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
	public function addFavorite(Post $post)
	{
		// Logic to add the post to favorites for the authenticated user
		auth()->user()->favorites()->attach($post->id);

		return redirect()->back();
	}

	public function removeFavorite(Post $post)
	{
		// Logic to remove the post from favorites for the authenticated user
		auth()->user()->favorites()->detach($post->id);

		return redirect()->back();
	}

	public function index()
	{

		$user = auth()->user();
		$favoritedPosts = $user->favorites()->get();

		return view('favorites.index', compact('favoritedPosts'));
	}
}