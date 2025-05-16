@extends('layouts.app')

@section('content')
<div class="bg-white px-6 py-32 lg:px-8">
    <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
        <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $post->title }}</h1>
        <p class="mt-6 text-xl/8">{{ $post->description }}</p>
        <img class="aspect-video rounded-xl bg-gray-50 object-cover mt-10" src="{{ $post->image }}" alt="{{ $post->title }}">
        <div class="mt-16 max-w-2xl">
            <p class="mt-6">{{ $post->body }}</p>
        </div>
        <div class="mt-16 font-bold">
            <a href="">{{ $post->author->name }}</a>
        </div>
    </div>
</div>


<div class="mt-16 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Comments</h2>

    @forelse ($comments as $comment)
        <div class="mb-6 border-b pb-4">
            <p class="font-semibold">{{ $comment->name }} 
                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </p>
            <p>{{ $comment->body }}</p>

            <form method="POST" action="{{ route('comments.delete', [$post, $comment]) }}" class="mt-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline">Delete</button>
        </form>
        
        </div>
    @empty
        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
    @endforelse
</div>



<div class="mt-16 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Leave a Comment</h2>
    <form id="comment-form" method="POST" action="{{ route('comments.store', $post) }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
                type="text"
                id="name" required
                name="name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        <div class="mb-4">
            <label for="body" class="block text-sm font-medium text-gray-700">Comment</label>
            <textarea
                id="body" required
                name="body"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            ></textarea>
        </div>

        <button type="submit"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
            Submit Comment
        </button>
    </form>
</div>
@endsection
