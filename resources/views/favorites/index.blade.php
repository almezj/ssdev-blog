@extends('layouts.app')

@section('content')
    <div class="container m-20">
        <h1 class="text-3xl font-bold mb-6">Favorite Posts</h1>

        @if ($favoritedPosts->isEmpty())
            <p>No favorite posts found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach ($favoritedPosts as $post)
				<a href="/blog/{{ $post->slug }}">
                    <div class="p-4 border rounded shadow">
					<img src="{{ asset('images/' . $post->image_path) }}" alt="">
                        <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>
                        <p>{{ $post->description }}</p>
                        <p class="mt-4 text-sm text-gray-500">Created on {{ $post->created_at->format('M j, Y') }}</p>
                    </div>
				</a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
