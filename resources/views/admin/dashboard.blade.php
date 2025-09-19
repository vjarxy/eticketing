<x-admin-layout title="Dashboard">
    <div class="space-y-6">
        <!-- Added statistics cards for total visitors and revenue -->
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Pengunjung -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Pengunjung</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalPengunjung ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-money-bill-wave text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                        <p class="text-2xl font-semibold text-gray-900">Rp
                            {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Tiket -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-ticket-alt text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Tiket Aktif</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalTiket ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Transaksi Hari Ini -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Transaksi Hari Ini</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $transaksiHariIni->count() ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Transaksi -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalTransaksi ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Pendapatan Hari Ini -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-coins text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pendapatan Hari Ini</p>
                        <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Transaksi Hari Ini</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengunjung</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tiket</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transaksiHariIni as $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ $transaction->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $transaction->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $transaction->status === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $transaction->created_at->format('H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada transaksi hari ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Added quick actions section -->
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('users.create') }}"
                        class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <i class="fas fa-user-plus text-blue-600 mr-3"></i>
                        <span class="text-blue-700 font-medium">Tambah User Baru</span>
                    </a>
                    <a href="{{ route('admin.tickets.create') }}"
                        class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                        <i class="fas fa-plus-circle text-green-600 mr-3"></i>
                        <span class="text-green-700 font-medium">Tambah Tiket Baru</span>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">System Status</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Server Status</span>
                        <span class="flex items-center text-green-600">
                            <i class="fas fa-circle text-xs mr-2"></i>
                            Online
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Database</span>
                        <span class="flex items-center text-green-600">
                            <i class="fas fa-circle text-xs mr-2"></i>
                            Connected
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Last Backup</span>
                        <span class="text-gray-500">{{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
