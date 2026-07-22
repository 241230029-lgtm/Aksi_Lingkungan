<!-- Overlay -->
<div
    id="loginModal"
    onclick="outsideClick(event)"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">

    <!-- Modal -->
    <div
        onclick="event.stopPropagation()"
        class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative -mt-20">

        <!-- Tombol Close -->
        <button
            onclick="closeLoginModal()"
            class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">

            &times;

        </button>

        <h2 class="text-3xl font-bold text-center text-green-700 mb-2">

            Selamat Datang

        </h2>

        <p class="text-center text-gray-500 mb-8">

            Silakan login untuk melanjutkan

        </p>

        @if ($errors->any())
            <div class="mb-5 p-4 bg-red-100 text-red-700 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">

            @csrf

            <!-- Pengguna -->
            <div class="mb-5">

                <label class="block font-semibold mb-2">

                    Pengguna

                </label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan pengguna"
                    autocomplete="off"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">

            </div>

            <!-- Password -->
            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Password

                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">

            </div>

            <!-- Tombol Login -->
            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">

                Login

            </button>

        </form>

    </div>

</div>
