<button data-modal-target="tambah-pegawai-modal" data-modal-toggle="tambah-pegawai-modal" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md" type="button">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    Tambah Pegawai
</button>

<!-- Main modal -->
<div id="tambah-pegawai-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-xl shadow-xl dark:bg-gray-800">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Tambah Data Pegawai Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white transition" data-modal-hide="tambah-pegawai-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            
            <form action="{{ route('employees.store') }}" method="POST" class="p-6 md:p-8">
                @csrf
                <div class="grid gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <!-- Nama Lengkap -->
                    <div class="sm:col-span-3">
                        <label for="nama_lengkap" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nama Lengkap</label>
                        <div class="mt-2">
                            <input type="text" name="nama_lengkap" id="nama_lengkap" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="sm:col-span-3">
                        <label for="nomor_telepon" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nomor Telepon</label>
                        <div class="mt-2">
                            <input type="tel" name="nomor_telepon" id="nomor_telepon" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="sm:col-span-3">
                        <label for="tanggal_lahir" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Tanggal Lahir</label>
                        <div class="mt-2">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500 dark:scheme-dark">
                        </div>
                    </div>

                    <!-- Departemen (Loop Dinamis) -->
                    <div class="sm:col-span-3">
                        <label for="departemen_id" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Departemen</label>
                        <div class="mt-2">
                            <select id="departemen_id" name="departemen_id" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500">
                                <option value="" disabled selected>Pilih Departemen</option>
                                {{-- Looping data departemen --}}
                                @foreach ( $departments as $department )
                                    <option value="{{ $department->id }}">{{ $department->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Jabatan (Loop Dinamis) -->
                    <div class="sm:col-span-3">
                        <label for="jabatan_id" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Jabatan</label>
                        <div class="mt-2">
                            <select id="jabatan_id" name="jabatan_id" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500">
                                <option value="" disabled selected>Pilih Jabatan</option>
                                {{-- Looping data jabatan (Asumsi variabelnya $jabatans) --}}
                                @foreach ( $positions as $position )
                                    <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="sm:col-span-3">
                        <label for="tanggal_masuk" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Tanggal Masuk</label>
                        <div class="mt-2">
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ date('Y-m-d') }}" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500 dark:scheme-dark">
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="sm:col-span-3">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Status</label>
                        <div class="mt-2">
                            <select id="status" name="status" class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500">
                                <option value="aktif" selected>Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="col-span-full">
                        <label for="alamat" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Alamat</label>
                        <div class="mt-2">
                            <textarea id="alamat" name="alamat" rows="3" required class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500"></textarea>
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-end gap-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="button" data-modal-hide="tambah-pegawai-modal" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-300 hover:text-gray-700 transition">
                        Batal
                    </button>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                        Simpan Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>