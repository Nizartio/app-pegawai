@extends('master')
@section('title', 'Daftar Jabatan')
@section('content')

<div class="container mx-auto p-4 md:p-8">
    
    {{-- 1. Judul Halaman Diubah --}}
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Jabatan</h1>

    <div class="flex justify-end mb-6">
        {{-- 2. Include diubah ke folder 'positions' --}}
        @include('positions.create')
    </div>

    <div class="relative overflow-x-auto shadow-xl rounded-lg border border-gray-100">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600">
            <thead class="text-xs text-gray-700 uppercase border-b bg-gray-50 border-gray-200">
                <tr>
                    {{-- 3. Header Tabel Diubah --}}
                    <th scope="col" class="px-6 py-3">Nama Jabatan</th>
                    <th scope="col" class="px-6 py-3">Gaji Pokok</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- 
                  4. Loop Diubah
                     - Menggunakan variabel $positions (dari Controller)
                     - Setiap item disebut $position
                --}}
                @forelse($positions as $position)
                <tr class="bg-white hover:bg-gray-100 transition duration-150 ease-in-out">
                    <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap">
                        {{ $position->nama_jabatan }}
                    </td>
                    <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap">
                        Rp{{ number_format($position->gaji_pokok, 0,",", ".") }}
                    </td>
                    <td class="px-6 py-4 flex items-center justify-start space-x-3">
                        {{-- 6. Include diubah ke folder 'positions' --}}
                        @include('positions.show')
                        @include('positions.edit')
                        @include('positions.destroy')
                    </td>
                </tr>
                @empty
                <tr class="bg-white dark:bg-gray-800">
                    <td colspan="7" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400 font-medium">
                        Belum ada data pegawai yang tercatat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection