@extends('layouts.main')

@section('container')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                alt="Your Company">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            @if (session()->has('success'))
                <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-2 py-1 rounded relative" role="alert">
                    <strong class="font-bold text-sm">{{ session('success') }}</strong>
                </div>
            @endif
            @if (session()->has('loginError'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-2 py-1 rounded relative"
                    role="alert">
                    <strong class="font-bold text-sm">{{ session('loginError') }}</strong>
                </div>
            @endif
            <form class="space-y-6" action="/login" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required autofocus
                            value="{{ old('email') }}"
                            class="@error('email') ring-red-600 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset  sm:text-sm sm:leading-6">
                        @error('email')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class=" block text-sm font-medium leading-6 text-gray-900">Password</label>

                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="@error('password') ring-red-600 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6">
                        @error('password')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Registrasi
                    disini</a>
            </p>
        </div>
    </div>
@endsection
