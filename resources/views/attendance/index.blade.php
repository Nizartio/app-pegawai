@extends('master')
@section('title', 'Daftar Absensi Pegawai')
@section('content')
<div class="container mx-auto p-4 md:p-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Absensi Pegawai</h1>
    
    <div class="flex justify-end mb-6">
        @include('attendance.create')
      </div>
    
    <div class="relative overflow-x-auto shadow-xl rounded-lg border border-gray-100 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Pegawai</th>
                    <th scope="col" class="px-6 py-3">Tanggal</th>
                    <th scope="col" class="px-6 py-3">Waktu Masuk</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Waktu Keluar / Absen Keluar</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                <tr class="bg-white hover:bg-gray-100 transition duration-150 ease-in-out dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $attendance->employee->nama_lengkap ?? 'Pegawai Tidak Ditemukan' }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $attendance->tanggal->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        {{-- Waktu Masuk --}}
                        {{ $attendance->waktu_masuk ? $attendance->waktu_masuk->format('H:i:s') : '—' }}
                    </td>
                    <td class="px-6 py-4">
                      @php
                          // Dapatkan nilai string dari Enum
                          $status_value = $attendance->status_absensi->value;
                          
                          // Dapatkan warna berdasarkan nilai string
                          $color = [
                              'hadir' => 'green', 
                              'izin' => 'yellow', 
                              'sakit' => 'blue', 
                              'alpha' => 'red'
                          ][$status_value] ?? 'gray';
                      @endphp
                      
                      <span class="font-medium px-3 py-1 rounded-full text-xs uppercase bg-{{$color}}-100 text-{{$color}}-700 dark:bg-{{$color}}-900 dark:text-{{$color}}-300">
                          {{-- Tampilkan nilai Enum yang sudah diformat (misal: "Hadir") --}}
                          {{ ucfirst($status_value) }}
                      </span>
                  </td>
                    
                    {{-- KOLOM DINAMIS WAKTU KELUAR / ABSEN KELUAR --}}
                    <td class="px-6 py-4">
                        @if ($attendance->waktu_keluar)
                            {{-- 1. Jika Sudah Absen Keluar --}}
                            <span class="text-gray-900 dark:text-white font-medium">
                                {{ $attendance->waktu_keluar->format('H:i:s') }}
                            </span>
                        @else
                            {{-- 2. Jika Belum Absen Keluar (Tampilkan Tombol) --}}
                            <form action="{{ route('attendance.update', $attendance->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action_type" value="absen_keluar">
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin mencatat absen keluar sekarang?')"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded text-xs transition duration-150 shadow-sm">
                                    Absen Keluar
                                </button>
                            </form>
                        @endif
                    </td>
                    
                    {{-- KOLOM AKSI (EDIT & DELETE) --}}
                    <td class="px-6 py-4 flex items-center justify-center space-x-2">
                        @include('attendance.edit') {{-- Akan kita buat nanti --}}
                        
                        @include('attendance.destroy')
                    </td>
                </tr>
                @empty
                <tr class="bg-white dark:bg-gray-800">
                    <td colspan="6" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400 font-medium">
                        Belum ada data absensi yang tercatat hari ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection