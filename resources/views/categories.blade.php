    @extends("layouts.main")

    @section("container")
        <h1 style="margin-bottom: 2rem">Blog Categories</h1>
        @foreach ($categories as $category)
            <h2>{{ $loop->iteration }}. <a href="/blog?category={{ $category->slug }}">{{ $category->name }}</a></h2>
        @endforeach
    @endsection
