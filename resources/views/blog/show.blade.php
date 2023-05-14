@extends('layouts.app') @section('content')
<div>
    <div class="w-4/5 m-auto pt-20">
        <a
            href="{{ route('blog.index') }}"
            class="border-b-2 pb-2 border-dotted italic text-gray-500"
        >
            &larr; Back to Blog Posts
        </a>
    </div>
</div>
<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            {{ $post->title }}
            <div class="text-gray-500 text-lg m-2">
                By
                <span
                    class="font-bold italic text-gray-800 mb-5"
                    >{{ $post->user->name }}</span
                >, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
            </div>
        </h1>

        <div class="mt-5">
            @foreach ($post->tags as $tag)
            <span
                class="post-tag bg-gray-200 rounded-full px-3 py-1 mx-1 text-sm text-gray-700 font-semibold"
            >
                <a class="pointer-events-none">{{ $tag->name }}</a>
            </span>
            @endforeach
        </div>
        <div class="mt-5">
            @auth @if (Auth::user()->favorites->contains($post))
            <form action="{{ route('posts.unfavorite', $post) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="unfavorite-button">
                    <span class="material-symbols-outlined star-filled">
						star
						</span>
                </button>
            </form>
            @else
            <form action="{{ route('posts.favorite', $post) }}" method="POST">
                @csrf
                <button type="submit" class="favorite-button">
                    <span class="material-symbols-outlined">
						star
						</span>
                </button>
            </form>
            @endif @endauth
        </div>
    </div>
    <div class="post-body text-2xl">
        {{ $post->description }}
    </div>
</div>

<div class="w-4/5 m-auto mt-10">
    <h2 class="text-3xl font-bold mb-5">Related Posts</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($relatedPosts as $relatedPost)
        <a
            href="{{ route('blog.show', $relatedPost->slug) }}"
            class="no-underline"
        >
            <div class="rounded overflow-hidden shadow-lg flex-column post-card">
                <div class="aspect-w-16 aspect-h-9">
                    <img
                        src="{{ asset('images/' . $relatedPost->image_path) }}"
                        alt=""
                        class="object-cover post-img"
                    />
                </div>
                <div class="flex-1">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">
                            {{ $relatedPost->title }}
                        </div>
                        <p class="text-gray-700 text-base">
                            {{ $relatedPost->description }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        @foreach ($relatedPost->tags as $tag)
                        <span
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"
                        >
                            {{ $tag->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection
