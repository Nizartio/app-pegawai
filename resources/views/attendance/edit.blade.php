<button data-modal-target="edit-absensi-modal-{{ $attendance->id }}" data-modal-toggle="edit-absensi-modal-{{ $attendance->id }}" 
        class="text-white bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-amber-600 dark:hover:bg-amber-700 dark:focus:ring-amber-800 transition shadow-sm" 
        type="button">
    Edit
</button>

<div id="edit-absensi-modal-{{ $attendance->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-xl shadow-xl dark:bg-gray-800">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Edit Absensi
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white transition" data-modal-hide="edit-absensi-modal-{{ $attendance->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            
            <form class="p-6 md:p-8" action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT') 

                <div class="grid gap-x-6 gap-y-8 sm:grid-cols-2">
                    
                    {{-- 1. PILIH KARYAWAN (Tidak bisa diubah jika absensi sudah dibuat) --}}
                    <div class="col-span-2">
                        <label for="karyawan_id_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Pegawai</label>
                        <select id="karyawan_id_{{ $attendance->id }}" name="karyawan_id" required 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500" disabled>
                            {{-- Dropdown hanya menampilkan pegawai yang sedang diedit (atau semua, tapi opsi yang benar terpilih) --}}
                            <option value="{{ $attendance->employee->id }}" selected>
                                {{ $attendance->employee->nama_lengkap ?? 'Pegawai Tidak Ditemukan' }}
                            </option>
                        </select>
                        {{-- Kirim ID melalui hidden input agar tetap bisa diproses di controller --}}
                        <input type="hidden" name="karyawan_id" value="{{ $attendance->karyawan_id }}">
                    </div>

                    {{-- 2. TANGGAL ABSENSI --}}
                    <div class="col-span-1">
                        <label for="tanggal_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Tanggal Absensi</label>
                        <input type="date" name="tanggal" id="tanggal_{{ $attendance->id }}" required 
                               value="{{ old('tanggal', $attendance->tanggal->format('Y-m-d')) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500 dark:[color-scheme:dark]">
                    </div>

                    {{-- 3. WAKTU MASUK --}}
                    <div class="col-span-1">
                        <label for="waktu_masuk_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Waktu Masuk</label>
                        <input type="time" name="waktu_masuk" id="waktu_masuk_{{ $attendance->id }}" required 
                               value="{{ old('waktu_masuk', $attendance->waktu_masuk ? $attendance->waktu_masuk->format('H:i') : '') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500 dark:[color-scheme:dark]">
                    </div>
                    
                    {{-- 4. WAKTU KELUAR --}}
                    <div class="col-span-1">
                        <label for="waktu_keluar_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Waktu Keluar (Opsional)</label>
                        <input type="time" name="waktu_keluar" id="waktu_keluar_{{ $attendance->id }}" 
                               value="{{ old('waktu_keluar', $attendance->waktu_keluar ? $attendance->waktu_keluar->format('H:i') : '') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500 dark:[color-scheme:dark]">
                    </div>

                    {{-- 5. STATUS ABSENSI --}}
                    <div class="col-span-1">
                        <label for="status_absensi_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Status Kehadiran</label>
                        <select id="status_absensi_{{ $attendance->id }}" name="status_absensi" required 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-amber-500">
                            
                            {{-- Asumsi $statuses adalah array/Enum yang dikirim dari controller --}}
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}" {{ old('status_absensi', $attendance->status_absensi) == $status->value ? 'selected' : '' }}>
                                    {{ ucfirst($status->value) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                {{-- Modal Footer --}}
                <div class="flex items-center justify-end gap-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" class="rounded-lg bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-amber-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>