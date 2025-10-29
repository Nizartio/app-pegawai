<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

// Hapus marker '>>>>>>> 2e1de29'
class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::with(['department', 'position'])->latest()->paginate(5);
        
        // Mengambil data untuk dropdown di modal create
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();

        return view('employees.index', compact('employees', 'departments', 'positions'));
    }

    public function create()
    {
        // Pilih versi dari 2e1de29 (lebih lengkap)
        // Mengambil data untuk dropdown di halaman create terpisah (jika digunakan)
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        
        return view('employees.create', compact('departments', 'positions'));
    } 
    
    public function store(Request $request)
    {
        // Pilih versi validasi dari 2e1de29 (lebih lengkap)
        // 1. Validasi input, perbaikan: Menggunakan 'jabatan_id' (sesuai DB)
        $validatedData = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:employees,email', // Pilih yang unique
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'status'         => 'required|string|max:50',
            'departemen_id'  => 'required|exists:departments,id', 
            'jabatan_id'     => 'required|exists:positions,id', // Pilih yang ada validasi foreign key
        ]);

        // Pilih versi create dari 2e1de29 (menggunakan $validatedData)
        // Menggunakan data yang sudah divalidasi
        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.'); // Pilih yang ada ->with()
    }

    public function show(string $id)
    {
        // Pilih versi dari 2e1de29 (lebih lengkap dengan eager loading & findOrFail)
        $employee = Employee::with(['department', 'position'])->findOrFail($id); // Menggunakan findOrFail
        return view('employees.show', compact('employee'));
    }
    
    public function edit(string $id)
    {
        // Pilih versi dari 2e1de29 (lebih lengkap dengan eager loading & findOrFail, serta ambil data dropdown)
        $employee = Employee::with(['department', 'position'])->findOrFail($id); // Menggunakan findOrFail
        
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, string $id)
    {
        // Pilih versi dari 2e1de29 (lebih lengkap)
        $employee = Employee::findOrFail($id);

        // 2. Validasi input
        $validatedData = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:employees,email,' . $employee->id, // Pilih yang unique
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'status'         => 'required|string|max:50',
            'departemen_id'  => 'required|exists:departments,id',
            'jabatan_id'     => 'required|exists:positions,id', // Pilih yang ada validasi foreign key
        ]);

        // Pilih versi update dari 2e1de29 (menggunakan $validatedData)
        // 3. Menggunakan data yang sudah divalidasi
        $employee->update($validatedData);
        
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui.'); // Pilih yang ada ->with()
    }

    public function destroy(string $id)
    {
        // Pilih versi dari 2e1de29 (lebih aman dengan findOrFail dan ada ->with())
        $employee = Employee::findOrFail($id); // Menggunakan findOrFail
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}