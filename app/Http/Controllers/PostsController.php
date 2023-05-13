<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Tag;

class PostsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$selectedTags = $request->input('tags', []);
		$query = $request->input('query', '');

		$posts = Post::when($selectedTags, function ($query, $selectedTags) {
			$query->whereHas('tags', function ($query) use ($selectedTags) {
				$query->whereIn('tags.id', $selectedTags);
			});
		})
			->when($query, function ($query, $searchTerm) {
				$query->where(function ($query) use ($searchTerm) {
					$query->where('title', 'like', '%' . $searchTerm . '%')
						->orWhere('description', 'like', '%' . $searchTerm . '%')
						->orWhereHas('user', function ($query) use ($searchTerm) {
								$query->where('name', 'like', '%' . $searchTerm . '%');
							});
				});
			})
			->orderBy('updated_at', 'DESC')
			->get();

		$tags = Tag::all(); // Fetch all tags

		return view('blog.index', compact('posts', 'tags', 'selectedTags', 'query'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$tags = Tag::all();

		return view('blog.create', compact('tags'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required',
			'description' => 'required',
			'image' => 'required|mimes:jpg,png,jpeg|max:5048',
			'tags' => 'required|array'
		]);

		$newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

		$request->image->move(public_path('images'), $newImageName);

		$post = Post::create([
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
			'image_path' => $newImageName,
			'user_id' => auth()->user()->id
		]);

		$tags = $request->input('tags', []);
		$post->tags()->attach($tags);

		return redirect('/blog')
			->with('message', 'Your post has been added!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $slug
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug)
	{

		$post = Post::where('slug', $slug)->firstOrFail();

		$relatedPosts = Post::whereHas('tags', function ($query) use ($post) {
			$query->whereIn('tags.id', $post->tags->pluck('id'));
		})
			->where('id', '!=', $post->id)
			->inRandomOrder()
			->limit(5)
			->get();

		return view('blog.show', compact('post', 'relatedPosts'))
			->with('post', Post::where('slug', $slug)->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $slug
	 * @return \Illuminate\Http\Response
	 */
	public function edit($slug)
	{

		$tags = Tag::all();

		return view('blog.edit', compact('tags'))
			->with('post', Post::where('slug', $slug)->first());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $slug
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $slug)
	{
		$request->validate([
			'title' => 'required',
			'description' => 'required',
			'tags' => 'required|array'
		]);

		$post = Post::where('slug', $slug)->firstOrFail();

		Post::where('slug', $slug)
			->update([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
				'user_id' => auth()->user()->id
			]);

		$tags = $request->input('tags', []);
		$post->tags()->sync($tags, false);

		return redirect('/blog')
			->with('message', 'Your post has been updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($slug)
	{
		$post = Post::where('slug', $slug);
		$post->delete();

		return redirect('/blog')
			->with('message', 'Your post has been deleted!');
	}

	/**
	 * Search for a post
	 *
	 * @param  Request $request
	 */
	public function search(Request $request)
	{
		$post = new Post();
		$query = $request->input('query');
		$posts = $post->search($query)->paginate(10);

		$tags = Tag::all();

		return view('blog.index', compact('posts', 'tags'));
	}

}