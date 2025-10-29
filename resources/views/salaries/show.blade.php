<button data-modal-target="show-salary-modal-{{ $salary->id }}" data-modal-toggle="show-salary-modal-{{ $salary->id }}" 
        type="button" 
        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900 shadow-sm">
    Detail
</button>

<div id="show-salary-modal-{{ $salary->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-xl max-h-full"> {{-- Width diperbesar sedikit --}}
        <div class="relative bg-white rounded-xl shadow-2xl dark:bg-gray-800">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Detail Gaji
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white transition" data-modal-hide="show-salary-modal-{{ $salary->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            
            <div class="p-4 md:p-6 space-y-4">
                
                {{-- Bagian Detail Pegawai & Departemen --}}
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Informasi Pegawai</h4>
                    <div class="relative overflow-x-auto border rounded-lg dark:border-gray-600">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
                            <tbody>
                                <tr class="bg-gray-50 dark:bg-gray-700/50">
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1/3">Nama Lengkap</th>
                                    <td class="px-4 py-2">{{ $salary->employee->nama_lengkap ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">Email</th>
                                    <td class="px-4 py-2">{{ $salary->employee->email ?? 'N/A' }}</td>
                                </tr>
                                <tr class="bg-gray-50 dark:bg-gray-700/50">
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">Departemen</th>
                                    <td class="px-4 py-2">{{ $salary->employee->department->nama_departemen ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Bagian Detail Gaji --}}
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Rincian Gaji</h4>
                    <div class="relative overflow-x-auto border rounded-lg dark:border-gray-600">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
                            <tbody>
                                <tr class="bg-gray-50 dark:bg-gray-700/50">
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1/3">Periode</th>
                                    <td class="px-4 py-2 text-end">{{$salary->bulan}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">Gaji Pokok</th>
                                    <td class="px-4 py-2 text-right">Rp{{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-gray-50 dark:bg-gray-700/50">
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">Tunjangan</th>
                                    <td class="px-4 py-2 text-right text-green-600 dark:text-green-400">+ Rp{{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">Potongan</th>
                                    <td class="px-4 py-2 text-right text-red-600 dark:text-red-400">- Rp{{ number_format($salary->potongan, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-700 font-bold text-gray-900 dark:text-white">
                                    <th scope="row" class="px-4 py-2">Total Gaji Diterima</th>
                                    <td class="px-4 py-2 text-right">Rp{{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>