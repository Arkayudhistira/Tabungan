<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @php
                        $user = auth()->user();
                    @endphp

                    @if ($user->role_id === 1) <!-- Misalnya 1 untuk admin -->
                        <h2 class="text-xl font-bold mb-4">Dashboard Admin Hitam</h2>
                        <table class="w-full border border-gray-500 text-sm">
                            <thead class="bg-gray-700 text-white">
                                <tr>
                                    <th class="border p-2">Nama</th>
                                    <th class="border p-2">Role</th>
                                    <th class="border p-2">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\User::with('tabungan')->get() as $u)
                                    <tr class="bg-gray-100 dark:bg-gray-900">
                                        <td class="border p-2">{{ $u->name }}</td>
                                        <td class="border p-2">{{ $u->role }}</td>
                                        <td class="border p-2">Rp{{ number_format($u->tabungan->sum('jumlah'), 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @elseif ($user->role_id === 2) <!-- Misalnya 2 untuk guru -->
                        <h2 class="text-xl font-bold mb-4">Dashboard Guru</h2>
                        <p>Selamat datang, {{ $user->name }}! Fitur khusus guru akan segera tersedia.</p>
                        <h2 class="text-xl font-bold mb-4">Permintaan Tabungan</h2>
                        <!-- Tempatkan fitur permintaan tabungan untuk guru di sini -->

                    @else
                        <h2 class="text-xl font-bold mb-4">Dashboard Siswa</h2>
                        <p>Halo {{ $user->name }}! Saldo tabungan kamu saat ini:</p>
                        <p class="text-lg font-semibold mt-2">Rp{{ number_format($user->tabungan->sum('jumlah'), 0, ',', '.') }}</p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
