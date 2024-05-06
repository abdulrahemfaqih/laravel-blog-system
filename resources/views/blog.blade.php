@extends('layouts.main')
@section('container')
    <h1 style="margin: 2rem 0">{{ $title }}</h1>
    <div class="container mx-auto py-4">

        <form action="/blog" method="GET" class="flex justify-center items-center">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                class="container border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200">Search</button>
        </form>
    </div>



    @if ($posts->count())
        <div class="container rounded-md shadow-md mb-6 bg-white">
            @if ($posts[0]->image)
                <div class="max-h-[400px] overflow-hidden">
                    <img class="my-6 w-full object-cover" src="{{ asset('storage/' . $posts[0]->image) }}"
                        alt="{{ $posts[0]->category->name }}">
                </div>
            @else
                <img src="https://source.unsplash.com/1200x400/?{{ $posts[0]->category->name }}"
                    alt="{{ $posts[0]->category->name }}">
            @endif

            <div class="py-4 px-6 flex flex-col gap-y-4">
                <h5 class="font-bold text-2xl text-blue-600">{{ $posts[0]->title }}</h5>
                <b>By. <a href="/blog?author={{ $posts[0]->author->username }}"
                        class="text-blue-600">{{ $posts[0]->author->name }}</a>
                    in
                    <a href="/blog?category={{ $posts[0]->category->slug }}" class="font-light">
                        <i>{{ $posts[0]->category->name }}</i>
                    </a>
                    <span class="text-xs font-normal text-gray-700">{{ $posts[0]->created_at->diffForHumans() }}</span>
                </b>
                <p>{{ $posts[0]->excerpt }}</p>
                <div class="mt-2 mb-4">
                    <a href="/blog/{{ $posts[0]->slug }}"
                        class="inline-block border-2 border-black rounded-md py-1 px-2">readmore</a>
                </div>
            </div>
        </div>



        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($posts->skip(1) as $post)
                    <div class="relative bg-white rounded-lg shadow-md flex flex-col">
                        @if ($post->image)
                            <div class="max-h-[400px] overflow-hidden">
                                <img class="my-6" src="{{ asset('storage/' . $post->image) }}"
                                    alt="{{ $post->category->name }}">
                            </div>
                        @else
                            <img class="w-full h-64 object-cover rounded-t-lg"
                                src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}"
                                alt="{{ $post->category->name }}">
                        @endif

                        <div class="absolute top-0 right-0 bg-white text-slate-900 px-2 py-1 m-2 rounded-lg text-xs">
                            <a href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                        </div>
                        <div class="p-4 flex-grow">
                            <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                            <b class="text-xs">By. <a href="/blo?author={{ $post->author->username }}"
                                    class="text-blue-600">{{ $post->author->name }}</a>
                                <span class="text-xs font-normal text-gray-700">
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </b>
                            <p class="text-gray-700 mt-2">{{ $post->excerpt }}</p>
                        </div>
                        <div class="p-4 mt-auto">
                            <a href="/blog/{{ $post->slug }}" class="text-sm text-gray-500">Read more</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center text-3xl font-bold underline">no post found.</p>
    @endif

    <div class="my-6">{{ $posts->links() }}</div>
@endsection
