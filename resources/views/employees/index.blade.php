@extends('master')
@section('title', 'Daftar Pegawai')
@section('content')
<div class="container mx-auto p-4 md:p-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Pegawai</h1>
      <div class="flex justify-end mb-6">
        @include('employees.create')
      </div>
    <div class="relative overflow-x-auto shadow-xl rounded-lg border border-gray-100">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Nomor Telepon</th>
                    <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Tanggal Masuk</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                <tr class="bg-white border-b hover:bg-gray-50 transition duration-150 ease-in-out">
                    <th scope="row" class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                        {{ $employee->nama_lengkap }}
                    </th>
                    <td class="px-6 py-4">{{ $employee->email }}</td>
                    <td class="px-6 py-4">{{ $employee->nomor_telepon }}</td>
                    <td class="px-6 py-4">{{ $employee->tanggal_lahir }}</td>
                    <td class="px-6 py-4">{{ $employee->alamat }}</td>
                    <td class="px-6 py-4">{{ $employee->tanggal_masuk }}</td>
                    <td class="px-6 py-4">
                        <span class="font-medium px-3 py-1 rounded-full text-xs
                            @if($employee->status == 'aktif')
                                bg-green-100 text-green-700
                            @else
                                bg-red-100 text-red-700
                            @endif
                        ">
                            {{ $employee->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex items-center justify-center space-x-3">
                      <div class="flex flex-col gap-y-2">
                        @include('employees.show')
                        @include('employees.edit')
                        @include('employees.destroy')
                      </div>
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
    <!-- End of Responsive Employee Table -->

</div>
@endsection
