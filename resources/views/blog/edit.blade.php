@extends('layouts.app') @section('content')
<div class="w-4/5 m-auto text-left">
    <div class="py-15 border-b border-gray-300">
        <h1 class="text-6xl">Update Post</h1>
    </div>
</div>

@if ($errors->any())
<div class="w-4/5 m-auto">
    <ul>
        @foreach ($errors->all() as $error)
        <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif

<div class="w-4/5 m-auto pt-20">
    <form
        action="/blog/{{ $post->slug }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf @method('PUT')

        <input
            type="text"
            name="title"
            value="{{ $post->title }}"
            class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none"
        />

        <textarea
			name="description"
            placeholder="Description..."
            class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">
			{{ $post->description }}
		</textarea>

        <div class="form-group">
            <select name="tags[]" id="tags" class="form-control" multiple>
                @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag->
                    id, $post->tags->pluck('id')->toArray()) ? 'selected' : ''
                    }}>
                    {{ $tag->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Submit Post
        </button>
    </form>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
/>

<script>
    $(document).ready(function () {
        $("#tags").select2({
            placeholder: "Choose tags",
            allowClear: true,
        });
    });
</script>
