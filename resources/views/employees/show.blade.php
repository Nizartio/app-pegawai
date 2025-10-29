<button data-modal-target="show-modal-{{ $employee->id }}" data-modal-toggle="show-modal-{{ $employee->id }}" type="button" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900 shadow-md">
    Detail
</button>

<div id="show-modal-{{ $employee->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-xl shadow-2xl dark:bg-gray-800">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Detail Pegawai
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white transition" data-modal-hide="show-modal-{{ $employee->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>
            
            <div class="p-4 md:p-5">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
                        <tbody>
                            {{-- Field Nama Lengkap --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white w-1/3">Nama Lengkap</th>
                                <td class="px-0 py-2">: {{ $employee->nama_lengkap }}</td>
                            </tr>
                            {{-- Field Email --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white">Email</th>
                                <td class="px-0 py-2">: {{ $employee->email }}</td>
                            </tr>
                            {{-- Field Nomor Telepon --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white">Nomor Telepon</th>
                                <td class="px-0 py-2">: {{ $employee->nomor_telepon }}</td>
                            </tr>
                            {{-- Field Tanggal Lahir --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white">Tanggal Lahir</th>
                                <td class="px-0 py-2">: {{ $employee->tanggal_lahir->format('d F Y') }}</td>
                            </tr>
                            {{-- Field Tanggal Masuk --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white">Tanggal Masuk</th>
                                <td class="px-0 py-2">: {{ $employee->tanggal_masuk->format('d F Y') }}</td>
                            </tr>
                            {{-- Field Departemen (Relasi) --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white">Departemen</th>
                                <td class="px-0 py-2">: {{ $employee->department->nama_departemen }}</td>
                            </tr>
                            {{-- Field Jabatan (Relasi) --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white">Jabatan</th>
                                <td class="px-0 py-2">: {{ $employee->position->nama_jabatan }}</td>
                            </tr>
                            {{-- Field Status --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white">Status</th>
                                <td class="px-0 py-2">
                                    <span>:</span>
                                    <span class="font-bold {{ $employee->status == 'aktif' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ ucfirst($employee->status) }}
                                    </span>
                                </td>
                            </tr>
                            {{-- Field Alamat --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-0 py-2 font-semibold text-gray-900 whitespace-nowrap dark:text-white align-top">Alamat</th>
                                <td class="px-0 py-2 text-justify">: {{ $employee->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>