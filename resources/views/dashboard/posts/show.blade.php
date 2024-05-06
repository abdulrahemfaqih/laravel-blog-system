@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <div class="flex gap-x-5">
            <a href="/dashboard/posts" class="underline">Back</a>
            <a href="/dashboard/posts/{{ $post->id }}/edit" class="underline">Edit</a>
            <form action="/dashboard/posts/{{ $post->id }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="underline" onclick="return confirm('yakin ingin dihapus? ')">
                    Delete
                </button>
            </form>
        </div>
        @if ($post->image)
            <div class="max-h-[400px] overflow-hidden">
                <img class="my-6" src="{{ asset('storage/' . $post->image) }}"
                    alt="{{ $post->category->name }}">
            </div>
        @else
            <img class="my-6" src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}"
                alt="{{ $post->category->name }}">
        @endif

        <div class="flex flex-col gap-y-4">{!! $post->body !!}</div>
    </div>
@endsection
