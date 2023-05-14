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
                    <span class="material-symbols-outlined"> star </span>
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
            <div
                class="rounded overflow-hidden shadow-lg flex-column post-card"
            >
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
<div class="comments-section mt-10">
    <h2 class="text-3xl font-bold mb-5">Comments</h2>

    @foreach ($post->comments as $comment)
    <div class="comment">
        <p>{{ $comment->content }}</p>
        <div class="comment-info">
            <span class="text-gray-600">{{ $comment->user->name }}</span>
            <span class="text-gray-400"
                >- {{ $comment->created_at->diffForHumans() }}</span
            >
            <span class="text-gray-400 comment-likes"
                >{{ $comment->likes->count() }} likes</span
            >
            <button
                class="like-button"
                data-comment-id="{{ $comment->id }}"
                data-is-liked="{{ $comment->likes->contains('user_id', auth()->user()->id) ? 'true' : 'false' }}"
            >
                {{ $comment->likes->contains('user_id', auth()->user()->id) ? 'Remove Like' : 'Like' }}
            </button>
        </div>
    </div>
    @endforeach @auth
    <div class="add-comment mt-5">
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea
                    name="content"
                    class="form-control"
                    placeholder="Add a comment"
                    rows="3"
                ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @else
    <p class="mt-5">
        <a href="{{ route('login') }}">Login</a> to leave a comment.
    </p>
    @endauth
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on("click", ".like-button", function (e) {
        e.preventDefault();
        var commentId = $(this).data("comment-id");
        var likeButton = $(this);
        var isLiked = $(this).data("is-liked") === "true";

        $.ajax({
            type: "POST",
            url: "/comments/" + commentId + "/like",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                if (response.success) {
                    if (response.isLiked) {
                        likeButton.text("Remove Like");
                    } else {
                        likeButton.text("Like");
                    }
                    likeButton.data("is-liked", response.isLiked);

                    // Update the like count in the DOM (THIS TOOK WAY TOO LONG TO IMPLEMENT)
                    var likesCountElement = likeButton.closest('.comment-info').find('.comment-likes');
                    if (likesCountElement.length) {
                        likesCountElement.text(response.likesCount + " likes");
                    }
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
</script>
@endsection
