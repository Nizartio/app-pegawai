<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Penting untuk validasi unik

class SalaryController extends Controller
{
    /**
     * Menampilkan daftar semua data gaji.
     */
    public function index()
    {
        $salaries = Salary::with([
                            'employee',                 // Muat relasi employee
                            'employee.department'       // Muat relasi department DARI employee
                        ])
                        ->latest('tahun') // Urutkan berdasarkan tahun dulu
                        ->latest('bulan') // Lalu berdasarkan bulan
                        ->paginate(10);

        // Anda juga perlu mengirim $employees untuk modal 'create'
        $employees = Employee::orderBy('nama_lengkap')->get(); 

        return view('salaries.index', compact('salaries', 'employees'));
    }

    /**
     * Menampilkan formulir untuk membuat data gaji baru.
     */
    public function create()
    {
        // Kirim daftar karyawan ke view untuk <select> dropdown
        $employees = Employee::orderBy('nama_lengkap')->get();
        
        return view('salaries.create', compact('employees'));
    }

    /**
     * Menyimpan data gaji baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input - Disesuaikan dengan input 'bulan' dan 'tahun' terpisah
        $validated = $request->validate([
            'karyawan_id' => [
                'required',
                'exists:employees,id',
                // Validasi unik: Kombinasi Karyawan, Bulan, dan Tahun harus unik
                Rule::unique('salaries')->where(function ($query) use ($request) {
                    return $query->where('bulan', $request->bulan) // Cocokkan bulan
                                 ->where('tahun', $request->tahun); // DAN cocokkan tahun
                }),
            ],
            // Validasi untuk 'bulan' (nama bulan)
            'bulan' => 'required|string|max:15', // Sesuaikan max jika perlu
            
            // Validasi untuk 'tahun'
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y') + 5),

            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ], [
            // Pesan error kustom
            'karyawan_id.unique' => 'Karyawan ini sudah memiliki data gaji untuk bulan dan tahun tersebut.',
        ]);
        
        // 'total_gaji' akan dihitung otomatis oleh Model event 'saving'.
        Salary::create($validated); // Langsung pakai $validated karena nama field cocok

        return redirect()->route('salary.index')
                         ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu data gaji.
     * (Route-model binding otomatis menemukan $salary)
     */
    public function show(Salary $salary)
    {
        // Pastikan relasi employee di-load
        $salary->load('employee');
        $department = Department::orderBy('nama_departemen')->get();
        
        return view('salaries.show', compact('salary'));
    }

    /**
     * Menampilkan formulir untuk mengedit data gaji.
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        
        return view('salaries.edit', compact('salary', 'employees'));
    }

    /**
     * Memperbarui data gaji di database.
     */
   public function update(Request $request, Salary $salary) // Route model binding sudah benar
    {
        // Validasi input - Disesuaikan dengan input 'bulan' (nama) dan 'tahun'
        $validated = $request->validate([
            'karyawan_id' => [
                'required',
                'exists:employees,id',
                // Validasi unik: Kombinasi Karyawan, Bulan, dan Tahun harus unik,
                // TAPI abaikan ID gaji yang sedang kita edit
                Rule::unique('salaries')->where(function ($query) use ($request) {
                    return $query->where('bulan', $request->bulan) // Cocokkan bulan (nama)
                                 ->where('tahun', $request->tahun); // DAN cocokkan tahun
                })->ignore($salary->id), // Ini penting untuk update
            ],
            // Validasi untuk 'bulan' (nama bulan dari hidden input)
            'bulan' => 'required|string|max:15', 
            
            // Validasi untuk 'tahun' (dari hidden input)
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y') + 5),

            // Validasi field yang bisa diedit
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0', 
            'potongan' => 'nullable|numeric|min:0',  
        ], [
            // Pesan error kustom
            'karyawan_id.unique' => 'Karyawan ini sudah memiliki data gaji untuk bulan dan tahun tersebut.',
        ]);

        // Lakukan update HANYA pada field yang boleh diedit
        // 'karyawan_id', 'bulan', 'tahun' tidak diubah.
        // 'total_gaji' akan dihitung ulang otomatis oleh event 'saving' di Model.
        $salary->update([
            'gaji_pokok' => $validated['gaji_pokok'],
            'tunjangan' => $validated['tunjangan'] ?? 0, // Beri nilai default 0 jika null
            'potongan' => $validated['potongan'] ?? 0,   // Beri nilai default 0 jika null
        ]);

        return redirect()->route('salary.index')
                         ->with('success', 'Data gaji berhasil diperbarui.');
    }

    /**
     * Menghapus data gaji dari database.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')
                         ->with('success', 'Data gaji berhasil dihapus.');
    }
}