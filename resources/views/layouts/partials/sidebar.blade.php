<aside class="w-72 bg-green-700 text-white">

    <div class="p-8">

        <h2 class="text-3xl font-bold">

            🌿 Admin

        </h2>

        <p class="text-green-200">

            Aksi Lingkungan

        </p>

    </div>

    <nav class="space-y-2 mt-8">

        <a href="{{ route('admin.dashboard') }}"
        class="block px-8 py-4 hover:bg-green-800">

            📊 Dashboard

        </a>

        <a href="{{ route('admin.users') }}"
        class="block px-8 py-4 hover:bg-green-800">

            👤 User

        </a>

        <a href="{{ route('admin.kegiatan') }}"
        class="block px-8 py-4 hover:bg-green-800">

            🌱 Kegiatan

        </a>

        <a href="{{ route('admin.information') }}"
        class="block px-8 py-4 hover:bg-green-800">

            📚 Informasi

        </a>

        <a href="{{ route('admin.sharing') }}"
        class="block px-8 py-4 hover:bg-green-800">

            💬 Sharing

        </a>

        <a href="{{ route('admin.volunteer') }}"
        class="block px-8 py-4 hover:bg-green-800">

            🤝 Volunteer

        </a>

    </nav>

</aside>