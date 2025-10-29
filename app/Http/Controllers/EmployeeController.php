<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index()
    {
        // Menggunakan eager loading untuk performa
        $employees = Employee::with(['department', 'position'])->latest()->paginate(5);
        
        // Mengambil data untuk dropdown di modal create
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();

        return view('employees.index', compact('employees', 'departments', 'positions'));
    }

    public function create()
    {
        // Mengambil data untuk dropdown di halaman create terpisah (jika digunakan)
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        
        return view('employees.create', compact('departments', 'positions'));
    } 
    
    public function store(Request $request)
    {
        // 1. Validasi input, perbaikan: Menggunakan 'jabatan_id' (sesuai DB)
        $validatedData = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:employees,email',
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'status'         => 'required|string|max:50',
            'departemen_id'  => 'required|exists:departments,id', 
            'jabatan_id'     => 'required|exists:positions,id', // <-- Diperbaiki dari 'position_id' ke 'jabatan_id'
        ]);

        // Menggunakan data yang sudah divalidasi
        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $employee = Employee::with(['department', 'position'])->findOrFail($id); // Menggunakan findOrFail
        return view('employees.show', compact('employee'));
    }
    
    public function edit(string $id)
    {
        $employee = Employee::with(['department', 'position'])->findOrFail($id); // Menggunakan findOrFail
        
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        // 2. Validasi input
        $validatedData = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'status'         => 'required|string|max:50',
            'departemen_id'  => 'required|exists:departments,id',
            'jabatan_id'     => 'required|exists:positions,id', // <-- Diperbaiki dari 'position_id' ke 'jabatan_id'
        ]);

        // 3. Menggunakan data yang sudah divalidasi
        $employee->update($validatedData);
        
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id); // Menggunakan findOrFail
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}