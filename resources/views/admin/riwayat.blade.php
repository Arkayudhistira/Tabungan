<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Tabungan') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Riwayat Setoran Siswa</h3>
            <table class="w-full text-left border-collapse border border-gray-300 dark:border-gray-600 rounded-lg mb-8">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nama Siswa</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Jumlah</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tanggal Setor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatSetor as $setor)
                        <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $setor->user->name }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rp{{ number_format($setor->jumlah, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $setor->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-4 text-gray-500 dark:text-gray-400">Tidak ada data setoran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Riwayat Persetujuan Guru</h3>
            <table class="w-full text-left border-collapse border border-gray-300 dark:border-gray-600 rounded-lg">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nama Siswa</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Jenis Ajuan</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Jumlah</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tanggal Disetujui</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatSetujui as $setujui)
                        <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $setujui->user->name }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 capitalize">{{ $setujui->jenis }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rp{{ number_format($setujui->jumlah, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $setujui->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-gray-500 dark:text-gray-400">Tidak ada data persetujuan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
