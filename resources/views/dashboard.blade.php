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
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif


@if ($user->role_id === 1) {{-- Admin --}}
<h2 class="text-xl font-bold mb-4">Dashboard Admin Hitam</h2>

<table class="w-full border border-gray-500 text-sm mb-8">
    <thead class="bg-gray-700 text-white sticky top-0">
        <tr>
            <th class="border p-2">Nama Siswa</th>
            <th class="border p-2">Jenis</th>
            <th class="border p-2">Jumlah</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Tanggal</th>
            <th class="border p-2">Disetujui Oleh</th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Models\AjuanTabungan::with(['user', 'approvedBy'])->orderBy('created_at', 'desc')->get() as $ajuan)
            <tr class="bg-gray-100 dark:bg-gray-900">
                <td class="border p-2">{{ $ajuan->user->name }}</td>
                <td class="border p-2 capitalize">{{ $ajuan->jenis }}</td>
                <td class="border p-2">Rp{{ number_format($ajuan->jumlah, 0, ',', '.') }}</td>
                <td class="border p-2 capitalize">{{ $ajuan->status }}</td>
                <td class="border p-2">{{ $ajuan->created_at->format('d M Y') }}</td>
                <td class="border p-2">
                    {{ $ajuan->approvedBy ? $ajuan->approvedBy->name : '-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<table class="w-full border border-gray-500 text-sm mb-8">
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

<h2 class="text-xl font-bold mb-4 mt-8">Riwayat Semua Ajuan Tabungan</h2>
<div class="overflow-x-auto max-h-96 overflow-y-auto border rounded">
    <table class="w-full border border-gray-500 text-sm">
        <thead class="bg-gray-700 text-white sticky top-0">
            <tr>
                <th class="border p-2">Nama Siswa</th>
                <th class="border p-2">Jenis</th>
                <th class="border p-2">Jumlah</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\AjuanTabungan::with('user')->orderBy('created_at', 'desc')->get() as $ajuan)
                <tr class="bg-gray-100 dark:bg-gray-900">
                    <td class="border p-2">{{ $ajuan->user->name }}</td>
                    <td class="border p-2 capitalize">{{ $ajuan->jenis }}</td>
                    <td class="border p-2">Rp{{ number_format($ajuan->jumlah, 0, ',', '.') }}</td>
                    <td class="border p-2 capitalize">{{ $ajuan->status }}</td>
                    <td class="border p-2">{{ $ajuan->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>





                    @elseif ($user->role_id === 2) {{-- Guru --}}
                        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Dashboard Guru</h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">Selamat datang, {{ $user->name }}!</p>


                        <h2 class="text-xl font-bold mt-6 mb-4 text-gray-800 dark:text-gray-100">Permintaan Tabungan</h2>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800 shadow rounded-lg">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                                        <th class="px-4 py-2 border">Nama Siswa</th>
                                        <th class="px-4 py-2 border">Jenis</th>
                                        <th class="px-4 py-2 border">Jumlah</th>
                                        <th class="px-4 py-2 border">Status</th>
                                        <th class="px-4 py-2 border">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(App\Models\AjuanTabungan::where('status', 'pending')->with('user')->get() as $ajuan)
                                        <tr class="text-gray-800 dark:text-gray-100">
                                            <td class="border px-4 py-2">{{ $ajuan->user->name }}</td>
                                            <td class="border px-4 py-2 capitalize">{{ $ajuan->jenis }}</td>
                                            <td class="border px-4 py-2">Rp{{ number_format($ajuan->jumlah, 0, ',', '.') }}</td>
                                            <td class="border px-4 py-2 capitalize">{{ $ajuan->status }}</td>
                                            <td class="border px-4 py-2">
                                                <div class="flex justify-end space-x-2">
                                                    <form action="{{ route('ajuan.setujui', $ajuan->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                                            Setujui
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('ajuan.tolak', $ajuan->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded ml-2">
                                                            Tolak
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500 dark:text-gray-400 py-4">Tidak ada ajuan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                    @else {{-- Siswa --}}
                        <h2 class="text-xl font-bold mb-4">Dashboard Siswa</h2>
                        <p class="mb-2 text-gray-700 dark:text-gray-300">Saldo tabungan kamu saat ini:</p>
                        <p class="text-2xl font-semibold text-green-600 dark:text-green-400 mb-6">
                            Rp{{ number_format($user->tabungan->sum('jumlah'), 0, ',', '.') }}
                        </p>

                        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Ajukan Tabungan</h2>

                        <form action="{{ route('ajuan.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded p-6 max-w-md">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jenis Ajuan</label>
                                <select name="jenis" class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" required class="...">
                                    <option value="setor">Setor</option>
                                    <option value="tarik">Tarik</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jumlah</label>
                                <input type="number" name="jumlah" class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" placeholder="Masukkan jumlah..." required min="1">
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Kirim Ajuan
                            </button>
                        </form>



                        <h3 class="text-lg font-bold mt-6 mb-2 text-gray-800 dark:text-gray-100">Riwayat Tabungan</h3>

                        <table class="min-w-full bg-white dark:bg-gray-800 shadow rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                                    <th class="px-4 py-2 border">Tanggal</th>
                                    <th class="px-4 py-2 border">Jenis</th>
                                    <th class="px-4 py-2 border">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\AjuanTabungan::where('user_id', $user->id)->where('status', 'success')->get() as $row)
                                    <tr class="text-gray-800 dark:text-gray-100">
                                        <td class="border px-4 py-2">{{ $row->created_at->format('d M Y') }}</td>
                                        <td class="border px-4 py-2 capitalize">{{ $row->jenis }}</td>
                                        <td class="border px-4 py-2">Rp{{ number_format($row->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
