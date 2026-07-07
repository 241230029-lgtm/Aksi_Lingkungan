<nav class="bg-white shadow-md sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">

                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl">
                    🌿
                </div>

                <div>

                    <h1 class="font-bold text-xl text-green-700">
                        AKSI
                    </h1>

                    <p class="text-xs text-gray-500 tracking-widest">
                        LINGKUNGAN
                    </p>

                </div>

            </a>

            <!-- Menu -->
            <div class="hidden lg:flex items-center gap-8 text-gray-700 font-medium">

                @if(session('role') == 'admin')

                    <a href="{{ route('admin.dashboard') }}"
                        class="hover:text-green-600 transition">

                        Dashboard

                    </a>

                    <a href="{{ route('admin.users') }}"
                        class="hover:text-green-600 transition">

                        Pengguna

                    </a>

                    <a href="{{ route('admin.kegiatan') }}"
                        class="hover:text-green-600 transition">

                        Kegiatan

                    </a>

                    <a href="{{ route('admin.information') }}"
                        class="hover:text-green-600 transition">

                        Informasi

                    </a>

                    <a href="{{ route('admin.sharing') }}"
                        class="hover:text-green-600 transition">

                        Sharing

                    </a>

                    <a href="{{ route('admin.volunteer') }}"
                        class="hover:text-green-600 transition">

                        Relawan

                    </a>

                @else

                    <a href="{{ route('dashboard') }}"
                        class="hover:text-green-600 transition">

                        Dashboard

                    </a>

                    <a href="{{ route('katalog') }}"
                        class="hover:text-green-600 transition">

                        Katalog

                    </a>

                    <a href="{{ route('buat-aksi') }}"
                        class="hover:text-green-600 transition">

                        Buat Aksi

                    </a>

                    <a href="{{ route('tentang') }}"
                        class="hover:text-green-600 transition">

                        Tentang

                    </a>

                @endif

            </div>

            <!-- Right -->
            <div class="flex items-center gap-5">

                @if(session('role') == 'user')

                <!-- Notification -->

                <button class="relative">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-600 hover:text-green-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0h6z" />

                    </svg>

                    <span class="absolute -top-1 -right-1 bg-red-500 w-3 h-3 rounded-full"></span>

                </button>

                @endif

                <!-- Profile -->

                <div class="flex items-center gap-3">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(session('name')) }}&background=16a34a&color=fff"
                        class="w-10 h-10 rounded-full">

                    <div class="hidden md:block">

                        <h3 class="font-semibold">

                            {{ session('name') }}

                        </h3>

                        <p class="text-xs text-gray-500">

{{ auth()->check() ? auth()->user()->name : 'Pengguna' }}
                        </p>

                    </div>

                </div>

                <!-- Logout -->

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>
