@extends('dashboard.layout.main')

@section('container')
    <div class="flex flex-col">
        <div class="flex justify-end">
            <a href="{{ route('categories.create') }}" class="font-semibold underline">Buat Category</a>
        </div>
        @if (session()->has('success'))
            <div class="mb-6 mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-2 py-1 rounded relative" role="alert">
                <strong class="font-bold text-sm">{{ session('success') }}</strong>
            </div>
        @endif
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    @if ($categories->isEmpty())
                        <div class="flex justify-center items-center min-h-[60vh]">
                            <p class="text-center font-bold text-2xl underline ">Belum ada cateory</p>
                        </div>
                    @else
                        <table class="min-w-full text-left text-sm font-light text-surface ">
                            <thead class="border-b border-slate-400 font-medium">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Category</th>
                                    <th scope="col" class="px-6 py-4">Slug</th>
                                    <th scope="col" class="px-6 py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr class="border-b border-slate-400">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $category->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $category->slug}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex gap-x-4">
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="hover:underline">Update</a>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="hover:underline"
                                                        onclick="return confirm('yakin ingin dihapus? ')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
