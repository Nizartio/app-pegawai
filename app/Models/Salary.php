<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = [
        'karyawan_id',
        'bulan',
        'tahun',
        'gaji_pokok',
        'tunjangan',
        'potongan',
    ];

    protected $casts = [
        'gaji_pokok' => 'decimal:2',
        'tunjangan' => 'decimal:2',
        'potongan' => 'decimal:2',
        'total_gaji' => 'decimal:2',
    ];

    /**
     * Mendefinisikan relasi "milik" ke model Employee.
     */
    public function employee(): BelongsTo
    {
        // Parameter kedua ('karyawan_id') diperlukan karena
        // nama kolom Anda tidak mengikuti konvensi Laravel ('employee_id').
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }

    protected static function booted(): void
    {
        static::saving(function ($salary) {
            // Hitung total_gaji secara otomatis
            $salary->total_gaji = ($salary->gaji_pokok + $salary->tunjangan) - $salary->potongan;
        });
    }
}