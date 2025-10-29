<button data-modal-target="details-modal-{{ $department->id }}" data-modal-toggle="details-modal-{{ $department->id }}" 
        class="block text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900" 
        type="button">
    Detail
</button>

<div id="details-modal-{{ $department->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-3xl max-h-full"> 
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Detail Departemen: {{ $department->nama_departemen }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="details-modal-{{ $department->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <div class="p-4 md:p-5 grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Kolom Info Departemen --}}
                <div class="col-span-1 md:col-span-1 border-r pr-6 dark:border-gray-600">
                    <h4 class="text-lg font-bold mb-2 text-gray-900 dark:text-white">Informasi Departemen</h4>
                    
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Departemen</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $department->nama_departemen }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300 italic">
                            {{ $department->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>
                
                {{-- Kolom Daftar Karyawan (Menggunakan @forelse) --}}
                <div class="col-span-1 md:col-span-2">
                    <h4 class="text-lg font-bold mb-3 text-gray-900 dark:text-white">Karyawan di Departemen ini</h4>
                    
                    <div id="employee-list-container" class="max-h-60 overflow-y-auto pr-2 space-y-2"> 
                        {{-- Mengganti @if/@foreach dengan @forelse --}}
                        @forelse ($department->employees as $employee) {{-- Akses relasi langsung --}}
                            <div class="flex items-center space-x-3 p-2 bg-gray-50 dark:bg-gray-600 rounded-lg">
                                <span class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></span>
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    {{ $employee->nama_lengkap }}
                                </p>
                            </div>
                        @empty 
                            {{-- Konten ini akan ditampilkan jika $department->employees kosong --}}
                            <p class="px-2 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                Belum ada karyawan di departemen ini.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>