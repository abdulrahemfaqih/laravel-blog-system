<nav class="shadow-md">
    <div class="nav__brand">
        <h1>F-Blog</h1>
    </div>
    <div class="nav__menu">
        <a class="{{ $active == 'home' ? 'link__active' : '' }}" href="/">Home</a>
        <a class="{{ $active == 'blog' ? 'link__active' : '' }}" href="/blog">Blog</a>
        <a class="{{ $active == 'categories' ? 'link__active' : '' }}" href="/categories">Categories</a>
    </div>

    @auth
        <div class="relative">
            <button id="userMenu" class="flex items-center text-sm font-medium focus:outline-none">
                <span>{{ Auth::user()->name }}</span>
                <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div id="userMenuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My dashboard</a>
                <form method="get" action="/logout">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm hover:text-white hover:bg-red-600 focus:outline-none">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="ctas">
            <a class="{{ $active == 'login' ? 'link__active' : '' }}" href="/login">Login</a>
        </div>
    @endauth

</nav>

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil elemen dropdown
            const dropdown = document.getElementById('userMenuDropdown');

            // Mengambil tombol dropdown
            const dropdownButton = document.getElementById('userMenu');

            // Menambahkan event listener untuk menampilkan dropdown saat tombol di klik
            dropdownButton.addEventListener('click', function() {
                dropdown.classList.toggle('hidden');
            });

            // Menutup dropdown saat klik di luar dropdown
            document.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target) && !dropdownButton.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
