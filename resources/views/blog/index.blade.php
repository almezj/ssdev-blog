@extends('layouts.app')

@section('content')
<div class="blog">

<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            Search for a topic that intersts you...
        </h1>
    </div>
</div>

<div class="filters">
	<form action="{{ route('posts.index') }}" method="GET" class="search-bar my-4 text-center">
		<input type="text" name="query" placeholder="Search..." class="border-2 border-gray-300 rounded px-4 py-2 my-2">
		
		<div class="form-group">
			<select name="tags[]" id="tags" class="form-control my-2" multiple>
				@foreach($tags as $tag)
					<option value="{{ $tag->id }}" {{ in_array($tag->id, request('tags', [])) ? 'selected' : '' }}>
						{{ $tag->name }}
					</option>
				@endforeach
			</select>
		</div>
		
		<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-4 py-2 my-2">Search and Apply Filters</button>
	</form>
</div>


@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

@if (Auth::check())
    <div class="pt-15 w-4/5 m-auto">
        <a 
            href="/blog/create"
            class="blog-btn bg-blue-500 hover:bg-blue-600 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
            Create post
        </a>
    </div>
@endif

@foreach ($posts as $post)
    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
		<div class="col-span-2">
			@foreach ($post->tags as $tag)
				<span class="post-tag bg-gray-200 rounded-full px-3 py-1 mx-1 text-sm text-gray-700 font-semibold">
					<a class="pointer-events-none">{{ $tag->name }}</a>
				</span>
			@endforeach
		</div>

        <div>
            <img src="{{ asset('images/' . $post->image_path) }}" alt="">
        </div>
        <div>
            <h2 class="text-gray-700 font-bold text-5xl pb-4">
                {{ $post->title }}
            </h2>

            <span class="text-gray-500">
                By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
            </span>

            <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {{ $post->description }}
            </p>

            <a href="/blog/{{ $post->slug }}" class="uppercase blog-btn bg-blue-500 hover:bg-blue-600 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Keep Reading
            </a>

            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                <span class="float-right">
                    <a 
                        href="/blog/{{ $post->slug }}/edit"
                        class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                        Edit
                    </a>
                </span>

                <span class="float-right">
                     <form 
                        action="/blog/{{ $post->slug }}"
                        method="POST">
                        @csrf
                        @method('delete')

                        <button
                            class="text-red-500 pr-3"
                            type="submit">
                            Delete
                        </button>

                    </form>
                </span>
            @endif
        </div>
    </div>    
</div>
@endforeach

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css">

<script>
    $(document).ready(function() {
        $('#tags').select2({
			placeholder: "Choose tags",
			allowClear: true
		});
    });
</script>