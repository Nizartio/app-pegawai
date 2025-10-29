<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Enums\AttendanceStatus; // Pastikan Anda sudah membuat Enum ini
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Untuk validasi unik yang canggih
use Illuminate\Validation\Rules\Enum as EnumRule; // Untuk validasi Enum

class AttendanceController extends Controller
{
    /**
     * Menampilkan daftar semua data absensi.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')
                                ->latest('tanggal')
                                ->paginate(10);
        $employees = Employee::orderBy('nama_lengkap')->get();
        $statuses = AttendanceStatus::cases();

        return view('attendance.index', compact('attendances', 'employees', 'statuses'));
    }

    /**
     * Menampilkan formulir untuk membuat data absensi baru.
     */
    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        $statuses = AttendanceStatus::cases();

        return view('attendance.create', compact('employees', 'statuses'));
    }

    /**
     * Menyimpan data absensi baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'karyawan_id' => [
                'required',
                'exists:employees,id',
                // Validasi unik: Pastikan tidak ada data absensi untuk karyawan ini di tanggal yang sama.
                Rule::unique('attendance')->where(function ($query) use ($request) {
                    return $query->where('tanggal', $request->tanggal);
                }),
            ],
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i', // Format Waktu (Jam:Menit)
            'waktu_keluar' => 'nullable|date_format:H:i|after_or_equal:waktu_masuk', // Waktu keluar harus setelah waktu masuk
            'status_absensi' => ['required', new EnumRule(AttendanceStatus::class)],
        ], [
            // Pesan error kustom untuk validasi unik
            'karyawan_id.unique' => 'Karyawan ini sudah memiliki data absensi di tanggal tersebut.'
        ]);

        Attendance::create($validated);

        return redirect()->route('attendance.index')
                         ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu data absensi.
     * (Route-model binding otomatis menemukan data $attendance)
     */
    public function show(Attendance $attendance)
    {
        // Load relasi employee jika belum ter-load
        $attendance->load('employee');
        
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Menampilkan formulir untuk mengedit data absensi.
     */
    public function edit(Attendance $attendance)
    {
        // Sama seperti create(), kita perlu data untuk form <select>
        $employees = Employee::orderBy('nama_lengkap')->get();
        $statuses = AttendanceStatus::cases();

        return view('attendance.edit', compact('attendance', 'employees', 'statuses'));
    }

    /**
     * Memperbarui data absensi di database.
     */
    public function update(Request $request, Attendance $attendance)
    {
        // Cek jika ini adalah permintaan Absen Keluar
        if ($request->has('action_type') && $request->action_type === 'absen_keluar') {
            
            // 1. Validasi untuk Absen Keluar
            $request->validate([
                'waktu_keluar' => 'nullable', // Hanya perlu memastikan kolom ada
            ]);

            // 2. Cek apakah sudah absen keluar
            if ($attendance->waktu_keluar) {
                return redirect()->route('attendance.index')->with('error', 'Pegawai ini sudah melakukan absen keluar.');
            }

            $attendance->waktu_keluar = now(); // Format waktu ke H:i:s
            $attendance->save();
            
            return redirect()->route('attendance.index')->with('success', 'Absen keluar berhasil dicatat pada ' . $attendance->waktu_keluar);
        } 
        
        // --- Logika Edit Biasa (Jika ada form edit yang dikirim) ---
        
        // Jika bukan absen keluar, jalankan validasi dan update penuh (untuk modal edit)
        $validated = $request->validate([
            // Anda perlu menambahkan validasi edit di sini
            // Misalnya:
            // 'karyawan_id' => 'required|exists:employees,id',
            // 'waktu_masuk' => 'required|date_format:H:i:s',
            // ... (dan lain-lain)
        ]);
        
        $attendance->update($validated);
        
        return redirect()->route('attendance.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        try {
            $attendance->delete();
            return redirect()->route('attendance.index')
                             ->with('success', 'Data absensi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('attendance.index')
                             ->with('error', 'Gagal menghapus data absensi: ' . $e->getMessage());
        }
    }
}