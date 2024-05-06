@extends('dashboard.layout.main')

@section('container')
    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-6">
                <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Nama Category</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="category" required
                                class="@error('nama') ring-red-600 @enderror block lg:w-1/2 w-full bg-white/50 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('name')
                                <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                        <div class="mt-2">
                            <input type="text" name="slug" id="slug" readonly
                                class="block lg:w-1/2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
            <a href="{{ route('categories.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
@endsection


@section('js')
    <script>
        const title = document.querySelector("#category")
        const slug = document.querySelector("#slug")

        title.addEventListener("change", function() {
            fetch("/dashboard/categories/checkSlug?name=" + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
@endsection
