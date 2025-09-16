<x-app-layout>
    <section
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-cyan-50 pt-16">
        <div class="max-w-4xl w-full mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Profile header with gradient background -->
                <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-12 text-white">
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-white"></i>
                        </div>
                        <div class="text-center md:text-left">
                            <h1 class="text-3xl font-bold">{{ auth()->user()->name }}</h1>
                            <p class="text-blue-100 text-lg">{{ ucfirst(auth()->user()->role) }}</p>
                            <p class="text-blue-200 text-sm">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Profile content with tabs -->
                <div class="p-8">
                    <div class="border-b border-gray-200 mb-8">
                        <nav class="-mb-px flex space-x-8">
                            <button
                                class="profile-tab active border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600"
                                data-tab="personal">
                                <i class="fas fa-user mr-2"></i>Informasi Personal
                            </button>
                            <button
                                class="profile-tab border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                data-tab="security">
                                <i class="fas fa-shield-alt mr-2"></i>Keamanan
                            </button>
                        </nav>
                    </div>

                    <!-- Personal Information Tab -->
                    <div id="personal-tab" class="tab-content">
                        <form action="{{ route('pengunjung.profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user mr-1"></i>Nama Lengkap
                                    </label>
                                    <input type="text" id="name" name="name"
                                        value="{{ auth()->user()->name }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-1"></i>Email
                                    </label>
                                    <input type="email" id="email" name="email"
                                        value="{{ auth()->user()->email }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Security Tab -->
                    <div id="security-tab" class="tab-content hidden">
                        <form action="{{ route('pengunjung.profile.password') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                <div class="flex">
                                    <i class="fas fa-exclamation-triangle text-yellow-400 mr-3 mt-1"></i>
                                    <div>
                                        <h3 class="text-sm font-medium text-yellow-800">Keamanan Password</h3>
                                        <p class="text-sm text-yellow-700 mt-1">Pastikan menggunakan password yang kuat
                                            dan unik untuk keamanan akun Anda.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-1"></i>Password Saat Ini
                                    </label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-key mr-1"></i>Password Baru
                                    </label>
                                    <input type="password" id="new_password" name="new_password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label for="new_password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-key mr-1"></i>Konfirmasi Password Baru
                                    </label>
                                    <input type="password" id="new_password_confirmation"
                                        name="new_password_confirmation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-shield-alt mr-2"></i>Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for tab functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.profile-tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');

                    // Remove active class from all tabs
                    tabs.forEach(t => {
                        t.classList.remove('active', 'border-blue-500', 'text-blue-600');
                        t.classList.add('border-transparent', 'text-gray-500');
                    });

                    // Add active class to clicked tab
                    this.classList.add('active', 'border-blue-500', 'text-blue-600');
                    this.classList.remove('border-transparent', 'text-gray-500');

                    // Hide all content
                    contents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Show target content
                    document.getElementById(targetTab + '-tab').classList.remove('hidden');
                });
            });
        });
    </script>
</x-app-layout>
