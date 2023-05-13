@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            {{ $post->title }}
			<div class="text-gray-500 text-lg m-2">
				By <span class="font-bold italic text-gray-800 mb-5">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
			</div>
        </h1>
		
		<div class="mt-5">
			@foreach ($post->tags as $tag)
				<span class="post-tag bg-gray-200 rounded-full px-3 py-1 mx-1 text-sm text-gray-700 font-semibold">
					<a class="pointer-events-none">{{ $tag->name }}</a>
				</span>
			@endforeach
		</div>
    </div>	
</div>

<div class="w-4/5 m-auto">
	<div class="w-1/2">
        <img src="{{ asset('images/' . $post->image_path) }}" alt="">
    </div>
    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
        {{ $post->description }}
    </p>
</div>
<div class="w-4/5 m-auto mt-10">
	<h2 class="text-3xl font-bold mb-5">Related Posts</h2>
	<div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
		@foreach ($relatedPosts as $relatedPost)
			<div class="border border-gray-300 rounded-md p-4">
				<img src="{{ asset('images/' . $relatedPost->image_path) }}" alt="" class="h-100">
				<h3 class="text-xl font-bold mb-2">{{ $relatedPost->title }}</h3>
				<p class="text-gray-600">{{ $relatedPost->description }}</p>
				<div class="mt-3">
					@foreach ($relatedPost->tags as $tag)
						<span class="post-tag bg-gray-200 rounded-full px-3 py-1 mx-1 text-sm text-gray-700 font-semibold">
							<a class="pointer-events-none">{{ $tag->name }}</a>
						</span>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection 