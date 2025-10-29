@extends('master')
@section('title', 'Daftar Gaji Pegawai')
@section('content')

<div class="container mx-auto p-4 md:p-8">
    
    {{-- 1. Judul Halaman --}}
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-200">Daftar Gaji Pegawai</h1>

    <div class="flex justify-end mb-6">
        {{-- Tombol Tambah Gaji (Asumsi ini modal create) --}}
        @include('salaries.create')
    </div>

    <div class="relative overflow-x-auto shadow-xl rounded-lg border border-gray-100 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                <tr>
                    {{-- Header Tabel Gaji --}}
                    <th scope="col" class="px-6 py-3">Nama Pegawai</th>
                    <th scope="col" class="px-6 py-3">Bulan/Tahun</th>
                    <th scope="col" class="px-6 py-3 text-right">Gaji Pokok</th>
                    <th scope="col" class="px-6 py-3 text-right">Tunjangan</th>
                    <th scope="col" class="px-6 py-3 text-right">Potongan</th>
                    <th scope="col" class="px-6 py-3 text-right">Total Gaji</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop data gaji ($salaries) --}}
                @forelse($salaries as $salary)
                <tr class="bg-white transition duration-150 ease-in-out dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    
                    {{-- Nama Pegawai (Melalui relasi employee) --}}
                    <th scope="row" class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $salary->employee->nama_lengkap ?? 'Pegawai Tidak Ditemukan' }}
                    </th>
                    
                    {{-- Bulan/Tahun Gaji --}}
                    <td class="px-6 py-4">
                        {{ $salary->bulan }}
                    </td>

                    {{-- Gaji Pokok --}}
                    <td class="px-6 py-4 text-right">
                        Rp{{ number_format($salary->gaji_pokok, 0, ',', '.') }}
                    </td>
                    
                    {{-- Tunjangan --}}
                    <td class="px-6 py-4 text-right">
                        <span class="text-green-600 dark:text-green-400">
                            + Rp{{ number_format($salary->tunjangan, 0, ',', '.') }}
                        </span>
                    </td>
                    
                    {{-- Potongan --}}
                    <td class="px-6 py-4 text-right">
                        <span class="text-red-600 dark:text-red-400">
                            - Rp{{ number_format($salary->potongan, 0, ',', '.') }}
                        </span>
                    </td>

                    {{-- Total Gaji --}}
                    <td class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white">
                        Rp{{ number_format($salary->total_gaji, 0, ',', '.') }}
                    </td>

                    {{-- Kolom Aksi --}}
                    <td class="px-6 py-4 flex items-center justify-center space-x-3">
                        <div class="flex gap-x-2">
                            @include('salaries.show')
                            @include('salaries.edit')
                            @include('salaries.destroy')
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="bg-white dark:bg-gray-800">
                    <td colspan="7" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400 font-medium">
                        Belum ada data gaji yang tercatat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination (jika menggunakan paginate() di Controller) --}}
    @if ($salaries->hasPages())
    <div class="mt-4">
        {{ $salaries->links() }}
    </div>
    @endif

</div>
@endsection