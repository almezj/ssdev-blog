@extends('layouts.app')

@section('content')
<div class="background-image grid grid-cols-1 m-auto bg-primary">
        <div class="flex text-text pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-blue-100 text-5xl uppercase font-bold text-shadow-md pb-14">
				Join the Conversation.
                </h1>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-1 gap-20 w-4/5 mx-auto py-15 border-b border-gray-300">
        <div>
            <img src="https://cdn.pixabay.com/photo/2014/05/03/01/03/laptop-336704_960_720.jpg" width="700" alt="">
        </div>

        <div class="m-auto sm:m-auto text-left w-4/5 block">
            <h2 class="text-3xl font-extrabold text-text">
                Interested in learning about the technology taking the world by storm?
            </h2>
            
            <p class="py-8 text-text text-s">
                We are a group of developers and designers who are excited about the future of technology. We are passionate about sharing our knowledge with the world. We are excited to have you join us on this journey.
            </p>
        </div>
    </div>

    <div class="text-center p-15 border-b border-gray-300 text-text">
        <h2 class="text-2xl pb-5 text-l"> 
            Our members are experts in...
        </h2>

        <span class="font-extrabold block text-4xl py-1">
            Artifical Intelligence
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Project Management
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Digital Strategy
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Backend Development
        </span>
    </div>

    <div class="text-center py-15">
        <h2 class="text-4xl font-bold py-10 text-text">
            Recent Posts
        </h2>
    </div>

    <div class="sm:grid grid-cols-1 w-4/5 m-auto">
	<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
		@if ($posts->isEmpty())
			<p>No posts found.</p>
		@else
        @foreach ($posts as $post)
        <a
            href="{{ route('blog.show', $post->slug) }}"
            class="no-underline"
        >
            <div class="rounded overflow-hidden shadow-lg flex-column post-card">
                <div class="aspect-w-16 aspect-h-9">
                    <img
                        src="{{ asset('images/' . $post->image_path) }}"
                        alt=""
                        class="object-cover post-img"
                    />
                </div>
                <div class="flex-1">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">
                            {{ $post->title }}
                        </div>
                        <p class="text-gray-700 text-base">
                            {{ $post->description }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        @foreach ($post->tags as $tag)
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
		@endif
    </div>
    </div>
	<div class="flex justify-center">
		<a href="/blog" class="uppercase blog-btn bg-blue-500 hover:bg-blue-600 text-gray-100 text-lg font-extrabold mt-10 py-4 px-8 rounded-3xl">
			Read More
		</a>
	</div>
@endsection