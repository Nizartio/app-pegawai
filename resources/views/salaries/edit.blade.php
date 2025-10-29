<button data-modal-target="edit-salary-modal-{{ $salary->id }}" data-modal-toggle="edit-salary-modal-{{ $salary->id }}" 
        class="block text-white bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-amber-600 dark:hover:bg-amber-700 dark:focus:ring-amber-800 transition shadow-sm" 
        type="button">
    Edit
</button>

<div id="edit-salary-modal-{{ $salary->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-lg max-h-full"> 
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Data Gaji
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-salary-modal-{{ $salary->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <form class="p-4 md:p-5" action="{{ route('salary.update', $salary->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid gap-4 mb-4 grid-cols-2">
                    
                    {{-- 1. PILIH KARYAWAN (Disabled) --}}
                    <div class="col-span-2">
                        <label for="karyawan_id_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pegawai</label>
                        <select id="karyawan_id_{{ $salary->id }}" name="karyawan_id_display" {{-- Ganti nama agar tidak konflik --}}
                                class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white cursor-not-allowed" disabled>
                            {{-- Hanya tampilkan pegawai yang terpilih --}}
                            <option value="{{ $salary->karyawan_id }}" selected>{{ $salary->employee->nama_lengkap ?? 'N/A' }}</option>
                        </select>
                        {{-- Kirim ID asli via hidden input --}}
                        <input type="hidden" name="karyawan_id" value="{{ $salary->karyawan_id }}">
                    </div>

                    {{-- 2. BULAN (Disabled) --}}
                    <div class="col-span-1">
                        <label for="bulan_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan</label>
                        <select name="bulan_display" id="bulan_{{ $salary->id }}" 
                                class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white cursor-not-allowed" disabled>
                            <option value="{{ $salary->bulan }}" selected>{{ $salary->bulan }}</option> 
                        </select>
                        <input type="hidden" name="bulan" value="{{ $salary->bulan }}">
                    </div>

                    {{-- 3. TAHUN (Disabled) --}}
                    <div class="col-span-1">
                        <label for="tahun_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                        <input type="number" name="tahun_display" id="tahun_{{ $salary->id }}" 
                               value="{{ old('tahun', $salary->tahun) }}"
                               class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white cursor-not-allowed" disabled>
                        <input type="hidden" name="tahun" value="{{ $salary->tahun }}">
                    </div>

                    {{-- 4. GAJI POKOK (Editable) --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="gaji_pokok_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gaji Pokok</label>
                        <input type="number" min="0" step="0.01" name="gaji_pokok" id="gaji_pokok_{{ $salary->id }}" 
                               value="{{ old('gaji_pokok', $salary->gaji_pokok) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Contoh: 5000000.00" required>
                    </div>

                    {{-- 5. TUNJANGAN (Editable) --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tunjangan_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tunjangan</label>
                        <input type="number" min="0" step="0.01" name="tunjangan" id="tunjangan_{{ $salary->id }}" 
                               value="{{ old('tunjangan', $salary->tunjangan) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="0.00">
                    </div>

                    {{-- 6. POTONGAN (Editable) --}}
                    <div class="col-span-2">
                        <label for="potongan_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Potongan</label>
                        <input type="number" min="0" step="0.01" name="potongan" id="potongan_{{ $salary->id }}" 
                               value="{{ old('potongan', $salary->potongan) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="0.00">
                    </div>

                </div>
                
                {{-- Modal Footer --}}
                <div class="flex items-center justify-end gap-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" class="text-white inline-flex items-center bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-amber-600 dark:hover:bg-amber-700 dark:focus:ring-amber-800 transition shadow-md">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-3m-1-5l2.293 2.293c.63.63.63 1.83 0 2.46l-4.293 4.293a1 1 0 01-.46.26l-3.376.994a1 1 0 01-1.21-1.21l.994-3.376a1 1 0 01.26-.46L18 8m-1 1a2 2 0 10-4 0m4 0a2 2 0 11-4 0"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>