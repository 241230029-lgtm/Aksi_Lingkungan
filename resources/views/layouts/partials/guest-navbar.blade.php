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
            <nav class="hidden lg:flex items-center gap-8 text-gray-700 font-medium">

                <a href="{{ route('home') }}"
                    class="hover:text-green-600 transition duration-300">

                    Beranda

                </a>

                <a href="#tentang"
                    class="hover:text-green-600 transition duration-300">

                    Tentang

                </a>

            </nav>

            <!-- Tombol Login -->
            <button
                type="button"
                onclick="openLoginModal()"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition duration-300 shadow-md">

                Login

            </button>

        </div>

    </div>

</nav>
