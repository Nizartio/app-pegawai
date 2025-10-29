<button data-modal-target="edit-pegawai-modal-{{ $employee->id }}" data-modal-toggle="edit-pegawai-modal-{{ $employee->id }}" 
        class="block text-white bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-2 py-2 text-center dark:bg-amber-600 dark:hover:bg-amber-700 dark:focus:ring-amber-800 transition" 
        type="button">
    Edit
</button>

<div id="edit-pegawai-modal-{{ $employee->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-xl shadow-xl dark:bg-gray-800">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Edit Data Pegawai: {{ $employee->nama_lengkap }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white transition" data-modal-hide="edit-pegawai-modal-{{ $employee->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            
            <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="p-6 md:p-8">
                @csrf
                @method('PUT') {{-- PENTING: Untuk method UPDATE --}}

                <div class="grid gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    {{-- Nama Lengkap --}}
                    <div class="sm:col-span-3">
                        <label for="nama_lengkap_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nama Lengkap</label>
                        <div class="mt-2">
                            <input type="text" name="nama_lengkap" id="nama_lengkap_{{ $employee->id }}" required 
                                   value="{{ old('nama_lengkap', $employee->nama_lengkap) }}"
                                   class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="sm:col-span-3">
                        <label for="email_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email_{{ $employee->id }}" required 
                                   value="{{ old('email', $employee->email) }}"
                                   class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">
                        </div>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="sm:col-span-3">
                        <label for="nomor_telepon_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nomor Telepon</label>
                        <div class="mt-2">
                            <input type="tel" name="nomor_telepon" id="nomor_telepon_{{ $employee->id }}" required 
                                   value="{{ old('nomor_telepon', $employee->nomor_telepon) }}"
                                   class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="sm:col-span-3">
                        <label for="tanggal_lahir_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Tanggal Lahir</label>
                        <div class="mt-2">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir_{{ $employee->id }}" required 
                                   value="{{ old('tanggal_lahir', $employee->tanggal_lahir?->format('Y-m-d')) }}" {{-- Gunakan ->format() karena di Model di-cast Carbon --}}
                                   class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500 dark:[color-scheme:dark]">
                        </div>
                    </div>

                    {{-- Departemen (Dropdown Dinamis) --}}
                    <div class="sm:col-span-3">
                        <label for="departemen_id_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Departemen</label>
                        <div class="mt-2">
                            <select id="departemen_id_{{ $employee->id }}" name="departemen_id" required 
                                    class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">
                                <option value="" disabled>Pilih Departemen</option>
                                @foreach ( $departments as $department )
                                    <option value="{{ $department->id }}" 
                                            {{ old('departemen_id', $employee->departemen_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->nama_departemen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Jabatan (Dropdown Dinamis) --}}
                    <div class="sm:col-span-3">
                        <label for="jabatan_id_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Jabatan</label>
                        <div class="mt-2">
                            <select id="jabatan_id_{{ $employee->id }}" name="jabatan_id" required 
                                    class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">
                                <option value="" disabled>Pilih Jabatan</option>
                                @foreach ( $positions as $position )
                                    <option value="{{ $position->id }}" 
                                            {{ old('jabatan_id', $employee->jabatan_id) == $position->id ? 'selected' : '' }}>
                                        {{ $position->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Tanggal Masuk --}}
                    <div class="sm:col-span-3">
                        <label for="tanggal_masuk_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Tanggal Masuk</label>
                        <div class="mt-2">
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk_{{ $employee->id }}" required 
                                   value="{{ old('tanggal_masuk', $employee->tanggal_masuk?->format('Y-m-d')) }}"
                                   class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500 dark:[color-scheme:dark]">
                        </div>
                    </div>
                    
                    {{-- Status --}}
                    <div class="sm:col-span-3">
                        <label for="status_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Status</label>
                        <div class="mt-2">
                            <select id="status_{{ $employee->id }}" name="status" 
                                    class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">
                                <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $employee->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-span-full">
                        <label for="alamat_{{ $employee->id }}" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Alamat</label>
                        <div class="mt-2">
                            <textarea id="alamat_{{ $employee->id }}" name="alamat" rows="3" required 
                                      class="block w-full rounded-lg border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">{{ old('alamat', $employee->alamat) }}</textarea>
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-end gap-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" class="rounded-lg bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-amber-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600 transition">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>