<button data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="block text-white bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-amber-600 dark:hover:bg-amber-700 dark:focus:ring-amber-800" type="button">
  Edit
</button>

<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-xl shadow-2xl dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Edit Departemen
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white transition" data-modal-toggle="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('departments.update', $department->id) }}" method="POST">
                @csrf
                @method('PUT') 

                <!-- Hidden input to store the department ID (useful for JavaScript) -->
                <input type="hidden" name="nama_departemen" id="edit_department_id" value="123">

                <div class="grid gap-4 mb-6 grid-cols-1">
                    <div class="col-span-1">
                        <label for="edit_nama_departemen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Nama Departemen</label>
                        <!-- Value attribute is pre-populated with existing data -->
                        <input type="text" name="nama_departemen" id="edit_nama_departemen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Masukkan nama departemen" value="{{ $department->nama_departemen }}" required="">
                    </div>
                    
                    <div class="col-span-1">
                        <label for="edit_deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Deskripsi</label>
                        <!-- Existing data inside textarea tags -->
                        <textarea id="edit_deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Jelaskan secara singkat tentang departemen">{{ $department->deskripsi }}</textarea>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="text-white inline-flex items-center bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-amber-600 dark:hover:bg-amber-700 dark:focus:ring-amber-800 transition">
                        <!-- Icon for Save/Edit -->
                        <svg class="me-1 -ms-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-3m-1-5l2.293 2.293c.63.63.63 1.83 0 2.46l-4.293 4.293a1 1 0 01-.46.26l-3.376.994a1 1 0 01-1.21-1.21l.994-3.376a1 1 0 01.26-.46L18 8m-1 1a2 2 0 10-4 0m4 0a2 2 0 11-4 0"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>