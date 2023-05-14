@extends('layouts.app')

@section('content')
<div class="background-image grid grid-cols-1 m-auto bg-primary">
        <div class="flex text-text pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-text text-5xl uppercase font-bold text-shadow-md pb-14">
				Unleash the power of AI with your coding skills.
                </h1>
                <a 
                    href="/blog"
                    class="text-center bg-secondary text-text py-2 px-4 font-bold text-xl uppercase">
                    Read More
                </a>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-text">
        <div>
            <img src="https://cdn.pixabay.com/photo/2014/05/03/01/03/laptop-336704_960_720.jpg" width="700" alt="">
        </div>

        <div class="m-auto sm:m-auto text-left w-4/5 block">
            <h2 class="text-3xl font-extrabold text-text">
                Struggling to be a better web developer?
            </h2>
            
            <p class="py-8 text-text text-s">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus.
            </p>

            <p class="font-extrabold text-text text-s pb-9">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente magnam vero nostrum! Perferendis eos molestias porro vero. Vel alias.
            </p>

            <a 
                href="/blog"
                class="uppercase bg-secondary text-text text-s font-extrabold py-3 px-8 rounded-3xl">
                Find Out More
            </a>
        </div>
    </div>

    <div class="text-center p-15 bg-secondary text-text">
        <h2 class="text-2xl pb-5 text-l"> 
            I'm an expert in...
        </h2>

        <span class="font-extrabold block text-4xl py-1">
            Ux Design
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
        <span class="uppercase text-s text-text">
            Blog
        </span>

        <h2 class="text-4xl font-bold py-10 text-text">
            Recent Posts
        </h2>

        <p class="m-auto w-4/5 text-text">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem saepe enim veritatis, eos temporibus quaerat facere consectetur qui.
        </p>
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
            <div class="rounded overflow-hidden shadow-lg flex-column">
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
@endsection