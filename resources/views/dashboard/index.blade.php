@extends('dashboard.layout.main')

@section('container')
    <div class="flex flex-col gap-y-6">
        <h1 class="text-3xl">Welcome Back, <span class="italic">{{ auth()->user()->name }}</span></h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white shadow-md rounded-md p-4">
                <h5 class="text-lg font-semibold text-gray-800 mb-2">Total Postingan Anda</h5>
                <p class="text-2xl font-bold text-gray-900">{{ $count_post }}</p>
            </div>
            <!-- Tambahkan card lainnya di sini -->
        </div>


    </div>
@endsection
