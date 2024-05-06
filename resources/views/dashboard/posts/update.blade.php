@extends('dashboard.layout.main')


@section('container')
    <form action="/dashboard/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="file" name="oldImage" value="{{ $post->image }}">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" required
                                value="{{ old('title', $post->title) }}"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                        <div class="mt-2">
                            <input type="text" name="slug" id="slug" readonly
                                value="{{ old('slug', $post->slug) }}"
                                class= "@error('slug') ring-red-600 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('slug')
                                <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                        <div class="mt-2">
                            <select id="category" name="category_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">


                                @foreach ($categories as $category)
                                    @if (old('category_id', $post->category->id) == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                        <div class="mt-2">
                            {{-- <textarea id="about" name="about" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea> --}}
                            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                            <trix-editor input="body"></trix-editor>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Gambar</label>
                        @if ($post->image)
                            <img class="img-preview img-preview object-cover rounded" src="{{ asset("storage/" . $post->image) }}">
                        @else
                            <img class="img-preview img-preview object-cover rounded" src="">
                        @endif

                        <div class="mt-2 ">
                            <input
                                class="@error('image') ring-red-600 @enderror relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-gray-700 focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                type="file" name="image" id="image" onchange="previewImage()" />
                            @error('image')
                                <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
        </div>
    </form>
@endsection

@section('js')
    <script>
        const title = document.querySelector("#title")
        const slug = document.querySelector("#slug")

        title.addEventListener("change", function() {
            fetch("/dashboard/posts/checkSlug?title=" + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
        document.addEventListener("trix-file-except", function(event) {
            event.preventDefailt()
        })


        function previewImage() {
            const image = document.querySelector("#image");
            const imgPreview = document.querySelector(".img-preview");

            // imgPreview.classList.add("h-[300px] w-[300px]");

            imgPreview.style.display = "block";

            if (image.files && image.files[0]) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    imgPreview.src = event.target.result;
                };

                reader.readAsDataURL(image.files[0]);
            }
        }
    </script>
@endsection
