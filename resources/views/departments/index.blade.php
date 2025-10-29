@extends('master')
@section('title', 'Daftar Departemen')
@section('content')
<div class="container mx-auto p-4 md:p-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Departemen</h1>
      <div class="flex justify-end mb-6">
        @include('departments.create')
    </div>
    <div class="relative overflow-x-auto shadow-xl rounded-lg border border-gray-100">
    <table class="w-full text-sm text-left rtl:text-right text-gray-600">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">Nama Departemen</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $department)
            <tr class="bg-white hover:bg-gray-100 transition duration-150 ease-in-out">
                <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap">
                    {{ $department->nama_departemen }}
                </td>
                <td class="px-6 py-4 flex items-center justify-center space-x-3">
                  @include('departments.show')
                  @include('departments.edit')
                  @include('departments.destroy')
                </td>
            </tr>
            @empty
                <tr class="bg-white dark:bg-gray-800">
                    <td colspan="7" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400 font-medium">
                        Belum ada data departemen yang tercatat.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>
@endsection
