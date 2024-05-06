@extends('layouts.main')

@section('container')
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <b>By. <a href="/blog?author?{{ $post->author->username }}">{{ $post->author->name }}</a>in
            <a href="/blog?category={{ $post->category->slug }}">
                <i>{{ $post->category->name }}</i>
            </a>
        </b>
        @if ($post->image)
            <div class="max-h-[400px] overflow-hidden">
                <img class="my-6" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}">
            </div>
        @else
            <img class="my-6" src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}"
                alt="{{ $post->category->name }}">
        @endif
        {!! $post->body !!}
    </div>
    <button class="btn__back"><a href="/blog">Back To Blog</a></button>
@endsection
